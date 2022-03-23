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
        $bulkId = 'bulkId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'bulkId' => $bulkId,
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
            ->setBulkId($bulkId)
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
        $bulkId = 'bulkId';

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'bulkId' => $bulkId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppImageMessageResource = (new WhatsAppImageMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
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
