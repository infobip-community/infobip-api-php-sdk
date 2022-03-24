<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\ImageContent;
use Infobip\Resources\WhatsApp\WhatsAppImageMessageResource;
use Tests\TestCase;

final class WhatsAppImageMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $content = new ImageContent('mediaUrl');
        $messageId = 'messageId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
            'callbackData' => $callbackData,
            'notifyUrl' => $notifyUrl,
        ];

        // act
        $whatsAppImageMessageResource = (new WhatsAppImageMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppImageMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $content = new ImageContent('mediaUrl');
        $messageId = 'messageId';

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppImageMessageResource = (new WhatsAppImageMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppImageMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $content = new ImageContent('mediaUrl');

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppImageMessageResource = new WhatsAppImageMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppImageMessageResource->payload());
    }
}
