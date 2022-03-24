<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\StickerContent;
use Infobip\Resources\WhatsApp\WhatsAppStickerMessageResource;
use Tests\TestCase;

final class WhatsAppStickerMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';
        $content = new StickerContent('mediaUrl');

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
            'callbackData' => $callbackData,
            'notifyUrl' => $notifyUrl,
        ];

        // act
        $whatsAppStickerMessageResource = (new WhatsAppStickerMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppStickerMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';
        $content = new StickerContent('mediaUrl');

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppStickerMessageResource = (new WhatsAppStickerMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppStickerMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $content = new StickerContent('mediaUrl');

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppStickerMessageResource = new WhatsAppStickerMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppStickerMessageResource->payload());
    }
}
