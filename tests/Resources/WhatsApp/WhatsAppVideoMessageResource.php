<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\VideoContent;
use Infobip\Resources\WhatsApp\WhatsAppVideoMessageResource;
use Tests\TestCase;

final class WhatsAppVideoMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $mediaUrl = 'mediaUrl';
        $caption = 'caption';
        $messageId = 'messageId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $content = new VideoContent($mediaUrl);
        $content->setCaption($caption);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
            'callbackData' => $callbackData,
            'notifyUrl' => $notifyUrl,
        ];

        // act
        $whatsAppVideoMessageResource = (new WhatsAppVideoMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppVideoMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $mediaUrl = 'mediaUrl';
        $messageId = 'messageId';

        $content = new VideoContent($mediaUrl);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppVideoMessageResource = (new WhatsAppVideoMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppVideoMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $mediaUrl = 'mediaUrl';
        $content = new VideoContent($mediaUrl);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppVideoMessageResource = new WhatsAppVideoMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppVideoMessageResource->payload());
    }
}
