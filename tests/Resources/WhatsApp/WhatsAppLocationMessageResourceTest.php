<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\LocationContent;
use Infobip\Resources\WhatsApp\WhatsAppLocationMessageResource;
use Tests\TestCase;

final class WhatsAppLocationMessageResourceTest extends TestCase
{
    public function testCanCreateWhatsAppLocationMessageResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $latitude = 2.5;
        $longitude = 2.5;
        $name = 'name';
        $address = 'address';
        $messageId = 'messageId';
        $bulkId = 'bulkId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $content = new LocationContent($longitude, $latitude);
        $content->setAddress($address);
        $content->setName($name);

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
        $whatsAppLocationMessageResource = (new WhatsAppLocationMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppLocationMessageResource->payload());
    }

    public function testCanCreateWhatsAppLocationMessageResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $latitude = 2.5;
        $longitude = 2.5;
        $messageId = 'messageId';
        $bulkId = 'bulkId';

        $content = new LocationContent($longitude, $latitude);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'bulkId' => $bulkId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppLocationMessageResource = (new WhatsAppLocationMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppLocationMessageResource->payload());
    }

    public function testCanCreateWhatsAppImageMessageResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $latitude = 2.5;
        $longitude = 2.5;
        $content = new LocationContent($longitude, $latitude);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppLocationMessageResource = new WhatsAppLocationMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppLocationMessageResource->payload());
    }
}
