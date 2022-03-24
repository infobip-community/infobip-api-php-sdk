<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Collections\PlaceholderCollection;
use Infobip\Resources\SMS\Models\Placeholder;
use Infobip\Resources\SMS\ResendTwoFAPinCodeOverVoiceResource;
use Tests\TestCase;

final class ResendTwoFAPinCodeOverVoiceResourceTest extends TestCase
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
        $resendTwoFAPinCodeOverVoiceResource = (new ResendTwoFAPinCodeOverVoiceResource($pinId))
            ->addPlaceholder($placeholder);

        // assert
        $this->assertSame($expectedArray, $resendTwoFAPinCodeOverVoiceResource->payload());
        $this->assertSame($pinId, $resendTwoFAPinCodeOverVoiceResource->getPinId());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $pinId = 'pinId';

        // act
        $resendTwoFAPinCodeOverVoiceResource = new ResendTwoFAPinCodeOverVoiceResource($pinId);

        // assert
        $this->assertSame($pinId, $resendTwoFAPinCodeOverVoiceResource->getPinId());
    }
}
