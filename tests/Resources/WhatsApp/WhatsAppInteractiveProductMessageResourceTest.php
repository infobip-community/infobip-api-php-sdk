<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\InteractiveProductAction;
use Infobip\Resources\WhatsApp\Models\InteractiveProductBody;
use Infobip\Resources\WhatsApp\Models\InteractiveProductContent;
use Infobip\Resources\WhatsApp\Models\InteractiveProductFooter;
use Infobip\Resources\WhatsApp\WhatsAppInteractiveProductMessageResource;
use Tests\TestCase;

final class WhatsAppInteractiveProductMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';
        $bulkId = 'bulkId';
        $footer = new InteractiveProductFooter('text');
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $body = new InteractiveProductBody('text');

        $action = new InteractiveProductAction('catalogId', 'productRetailerId');
        $content = new InteractiveProductContent($body, $action);
        $content->setFooter($footer);

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
        $whatsAppInteractiveProductMessageResource = (new WhatsAppInteractiveProductMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveProductMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';

        $body = new InteractiveProductBody('text');

        $action = new InteractiveProductAction('catalogId', 'productRetailerId');
        $content = new InteractiveProductContent($body, $action);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppInteractiveProductMessageResource = (new WhatsAppInteractiveProductMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveProductMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';

        $body = new InteractiveProductBody('text');

        $action = new InteractiveProductAction('catalogId', 'productRetailerId');
        $content = new InteractiveProductContent($body, $action);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppInteractiveProductMessageResource = new WhatsAppInteractiveProductMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveProductMessageResource->payload());
    }
}
