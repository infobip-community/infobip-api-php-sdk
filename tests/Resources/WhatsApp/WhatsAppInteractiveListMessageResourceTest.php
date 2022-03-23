<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\InteractiveListAction;
use Infobip\Resources\WhatsApp\Models\InteractiveListBody;
use Infobip\Resources\WhatsApp\Models\InteractiveListContent;
use Infobip\Resources\WhatsApp\Models\InteractiveListFooter;
use Infobip\Resources\WhatsApp\Models\InteractiveListTextHeader;
use Infobip\Resources\WhatsApp\Models\Section;
use Infobip\Resources\WhatsApp\WhatsAppInteractiveListMessageResource;
use Tests\TestCase;

final class WhatsAppInteractiveListMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';
        $bulkId = 'bulkId';
        $header = new InteractiveListTextHeader('type');
        $footer = new InteractiveListFooter('text');
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $body = new InteractiveListBody('text');
        $action = new InteractiveListAction('title');
        $action->addSection((new Section())->setTitle('title'));
        $content = new InteractiveListContent($body, $action);
        $content->setHeader($header);
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
        $whatsAppInteractiveListMessageResource = (new WhatsAppInteractiveListMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveListMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';
        $bulkId = 'bulkId';
        $body = new InteractiveListBody('text');
        $action = new InteractiveListAction('title');
        $content = new InteractiveListContent($body, $action);


        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'bulkId' => $bulkId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppInteractiveListMessageResource = (new WhatsAppInteractiveListMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveListMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $body = new InteractiveListBody('text');
        $action = new InteractiveListAction('title');
        $content = new InteractiveListContent($body, $action);


        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppInteractiveListMessageResource = new WhatsAppInteractiveListMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveListMessageResource->payload());
    }
}
