<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\DocumentContent;
use Infobip\Resources\WhatsApp\WhatsAppDocumentMessageResource;
use Tests\TestCase;

final class WhatsAppDocumentMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $content = new DocumentContent('mediaUrl');
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
        $whatsAppDocumentMessageResource = (new WhatsAppDocumentMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppDocumentMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $content = new DocumentContent('mediaUrl');
        $messageId = 'messageId';

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppDocumentMessageResource = (new WhatsAppDocumentMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppDocumentMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $content = new DocumentContent('mediaUrl');

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppDocumentMessageResource = new WhatsAppDocumentMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppDocumentMessageResource->payload());
    }
}
