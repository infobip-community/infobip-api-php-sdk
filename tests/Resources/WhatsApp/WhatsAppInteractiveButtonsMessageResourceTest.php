<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\ReplyInteractiveButtons;
use Infobip\Resources\WhatsApp\Models\InteractiveButtonsAction;
use Infobip\Resources\WhatsApp\Models\InteractiveButtonsBody;
use Infobip\Resources\WhatsApp\Models\InteractiveButtonsContent;
use Infobip\Resources\WhatsApp\Models\InteractiveButtonsFooter;
use Infobip\Resources\WhatsApp\Models\InteractiveButtonsTextHeader;
use Infobip\Resources\WhatsApp\WhatsAppInteractiveButtonsMessageResource;
use Tests\TestCase;

final class WhatsAppInteractiveButtonsMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';
        $bulkId = 'bulkId';
        $header = new InteractiveButtonsTextHeader('type');
        $footer = new InteractiveButtonsFooter('text');
        $body = new InteractiveButtonsBody('text');
        $action = new InteractiveButtonsAction();
        $action->addInteractiveButton(new ReplyInteractiveButtons('id', 'title'));
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';
        $content = new InteractiveButtonsContent($body, $action, $header, $footer);

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
        $whatsAppInteractiveButtonsMessageResource = (new WhatsAppInteractiveButtonsMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveButtonsMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';
        $bulkId = 'bulkId';
        $header = new InteractiveButtonsTextHeader('type');
        $footer = new InteractiveButtonsFooter('text');
        $body = new InteractiveButtonsBody('text');
        $action = new InteractiveButtonsAction();
        $action->addInteractiveButton(new ReplyInteractiveButtons('id', 'title'));
        $content = new InteractiveButtonsContent($body, $action, $header, $footer);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'bulkId' => $bulkId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppInteractiveButtonsMessageResource = (new WhatsAppInteractiveButtonsMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveButtonsMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $header = new InteractiveButtonsTextHeader('text');
        $footer = new InteractiveButtonsFooter('text');
        $body = new InteractiveButtonsBody('text');
        $action = new InteractiveButtonsAction();
        $action->addInteractiveButton(new ReplyInteractiveButtons('id', 'title'));
        $content = new InteractiveButtonsContent($body, $action, $header, $footer);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppInteractiveButtonsMessageResource = new WhatsAppInteractiveButtonsMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveButtonsMessageResource->payload());
    }
}
