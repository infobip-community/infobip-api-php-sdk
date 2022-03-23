<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Collections\PlaceholderCollection;
use Infobip\Resources\SMS\Models\Placeholder;
use Infobip\Resources\SMS\SendTwoFAPinCodeOverVoiceResource;
use Tests\TestCase;

final class SendTwoFAPinCodeOverVoiceResourceTest extends TestCase
{
    public function testCanResourceWithAllData(): void
    {
        // arrange
        $applicationId =  'applicationId';
        $from = 'from';
        $messageId = 'messageId';
        $placeholder = new Placeholder('firstName', 'John');
        $placeholders = (new PlaceholderCollection())
            ->add($placeholder);
        $to = 'to';

        $expectedArray = [
            'applicationId' => $applicationId,
            'from' => $from,
            'messageId' => $messageId,
            'placeholders' => $placeholders->toArray(),
            'to' => $to
        ];

        // act
        $sendTwoFAPinCodeOverVoiceResource = (new SendTwoFAPinCodeOverVoiceResource(
            $applicationId,
            $messageId,
            $to
        ))
            ->addPlaceholder($placeholder)
            ->setFrom($from);

        // assert
        $this->assertSame($expectedArray, $sendTwoFAPinCodeOverVoiceResource->payload());
    }

    public function testCanResourceWithPartialData(): void
    {
        // arrange
        $applicationId =  'applicationId';
        $from = 'from';
        $messageId = 'messageId';
        $to = 'to';

        $expectedArray = [
            'applicationId' => $applicationId,
            'from' => $from,
            'messageId' => $messageId,
            'to' => $to
        ];

        // act
        $sendTwoFAPinCodeOverVoiceResource = (new SendTwoFAPinCodeOverVoiceResource(
            $applicationId,
            $messageId,
            $to
        ))
            ->setFrom($from);

        // assert
        $this->assertSame($expectedArray, $sendTwoFAPinCodeOverVoiceResource->payload());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $applicationId =  'applicationId';
        $messageId = 'messageId';
        $to = 'to';

        $expectedArray = [
            'applicationId' => $applicationId,
            'messageId' => $messageId,
            'to' => $to
        ];

        // act
        $sendTwoFAPinCodeOverVoiceResource = new SendTwoFAPinCodeOverVoiceResource(
            $applicationId,
            $messageId,
            $to
        );

        // assert
        $this->assertSame($expectedArray, $sendTwoFAPinCodeOverVoiceResource->payload());
    }
}
