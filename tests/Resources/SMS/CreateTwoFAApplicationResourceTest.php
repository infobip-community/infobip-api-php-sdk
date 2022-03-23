<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\CreateTwoFAApplicationResource;
use Infobip\Resources\SMS\Models\TwoFAApplicationConfiguration;
use Tests\TestCase;

final class CreateTwoFAApplicationResourceTest extends TestCase
{
    public function testCanResourceWithAllData(): void
    {
        // arrange
        $configuration = (new TwoFAApplicationConfiguration())
            ->setAllowMultiplePinVerifications(true);
        $name = 'name';

        $expectedArray = [
            'configuration' => $configuration->toArray(),
            'enabled' => true,
            'name' => $name
        ];

        // act
        $createTwoFAApplicationResource = (new CreateTwoFAApplicationResource($name))
            ->setConfiguration($configuration)
            ->setEnabled(true);

        // assert
        $this->assertSame($expectedArray, $createTwoFAApplicationResource->payload());
    }

    public function testCanResourceWithPartialData(): void
    {
        // arrange
        $name = 'name';

        $expectedArray = [
            'enabled' => true,
            'name' => $name
        ];

        // act
        $createTwoFAApplicationResource = (new CreateTwoFAApplicationResource($name))
            ->setEnabled(true);

        // assert
        $this->assertSame($expectedArray, $createTwoFAApplicationResource->payload());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $name = 'name';

        $expectedArray = [
            'name' => $name
        ];

        // act
        $createTwoFAApplicationResource = new CreateTwoFAApplicationResource($name);

        // assert
        $this->assertSame($expectedArray, $createTwoFAApplicationResource->payload());
    }
}
