<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Models\TwoFAApplicationConfiguration;
use Infobip\Resources\SMS\UpdateTwoFAApplicationResource;
use Tests\TestCase;

final class UpdateTwoFAApplicationResourceTest extends TestCase
{
    public function testCanResourceWithAllData(): void
    {
        // arrange
        $configuration = (new TwoFAApplicationConfiguration())
            ->setAllowMultiplePinVerifications(true);
        $name = 'name';
        $appId = 'appId';

        $expectedArray = [
            'configuration' => $configuration,
            'enabled' => true,
            'name' => $name
        ];

        // act
        $updateTwoFAApplicationResource = (new UpdateTwoFAApplicationResource($appId, $name))
            ->setConfiguration($configuration)
            ->setEnabled(true);

        // assert
        $this->assertSame($expectedArray, $updateTwoFAApplicationResource->payload());
        $this->assertSame($appId, $updateTwoFAApplicationResource->getAppId());
    }

    public function testCanResourceWithPartialData(): void
    {
        // arrange
        $configuration = (new TwoFAApplicationConfiguration())
            ->setAllowMultiplePinVerifications(true);
        $name = 'name';
        $appId = 'appId';

        $expectedArray = [
            'configuration' => $configuration,
            'name' => $name
        ];

        // act
        $updateTwoFAApplicationResource = (new UpdateTwoFAApplicationResource($appId, $name))
            ->setConfiguration($configuration);

        // assert
        $this->assertSame($expectedArray, $updateTwoFAApplicationResource->payload());
        $this->assertSame($appId, $updateTwoFAApplicationResource->getAppId());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $name = 'name';
        $appId = 'appId';

        $expectedArray = [
            'name' => $name
        ];

        // act
        $updateTwoFAApplicationResource = new UpdateTwoFAApplicationResource($appId, $name);

        // assert
        $this->assertSame($expectedArray, $updateTwoFAApplicationResource->payload());
        $this->assertSame($appId, $updateTwoFAApplicationResource->getAppId());
    }
}
