<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Collections\PlaceholderCollection;
use Infobip\Resources\SMS\Models\Placeholder;
use Infobip\Resources\SMS\ResendTwoFAPinCodeOverSMSResource;
use Tests\TestCase;

final class ResendTwoFAPinCodeOverSMSResourceTest extends TestCase
{
    public function testCanResourceWithAllData(): void
    {
        // arrange
        $pinId = 'pinId';
        $placeholder = new Placeholder('firstName', 'John');
        $placeholders = (new PlaceholderCollection())
            ->add($placeholder);

        $expectedArray = [
            'placeholders' => $placeholders->toArray(),
        ];

        // act
        $resendTwoFAPinCodeOverSMSResource = (new ResendTwoFAPinCodeOverSMSResource($pinId))
            ->addPlaceholder($placeholder);

        // assert
        $this->assertSame($expectedArray, $resendTwoFAPinCodeOverSMSResource->payload());
        $this->assertSame($pinId, $resendTwoFAPinCodeOverSMSResource->getPinId());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $pinId = 'pinId';

        // act
        $resendTwoFAPinCodeOverSMSResource = new ResendTwoFAPinCodeOverSMSResource($pinId);

        // assert
        $this->assertSame($pinId, $resendTwoFAPinCodeOverSMSResource->getPinId());
    }
}
