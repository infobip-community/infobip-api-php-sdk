<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\VerifyPhoneNumberResource;
use Tests\TestCase;

final class VerifyPhoneNumberResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $pinId = 'pinId';
        $pin = 'pin';

        $expectedArray = [
            'pin' => 'pin'
        ];

        // act
        $verifyPhoneNumberResource = new VerifyPhoneNumberResource($pinId, $pin);

        // assert
        $this->assertSame($expectedArray, $verifyPhoneNumberResource->payload());
        $this->assertSame($pinId, $verifyPhoneNumberResource->getPinId());
    }
}
