<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\TextContent;
use Infobip\Resources\WhatsApp\WhatsAppTextMessageResource;
use Tests\TestCase;

final class WhatsAppTextMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $text = 'text';
        $messageId = 'messageId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $content = new TextContent($text);
        $content->setPreviewUrl(true);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
            'callbackData' => $callbackData,
            'notifyUrl' => $notifyUrl,
        ];

        // act
        $whatsAppTextMessageResource = (new WhatsAppTextMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppTextMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $text = 'text';
        $messageId = 'messageId';

        $content = new TextContent($text);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppTextMessageResource = (new WhatsAppTextMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppTextMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $text = 'text';
        $content = new TextContent($text);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppTextMessageResource = new WhatsAppTextMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppTextMessageResource->payload());
    }
}
