<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Collections\ProductRetailerIdCollection;
use Infobip\Resources\WhatsApp\Models\InteractiveMultiProductAction;
use Infobip\Resources\WhatsApp\Models\InteractiveMultiProductBody;
use Infobip\Resources\WhatsApp\Models\InteractiveMultiProductContent;
use Infobip\Resources\WhatsApp\Models\InteractiveMultiProductFooter;
use Infobip\Resources\WhatsApp\Models\InteractiveMultiProductTextHeader;
use Infobip\Resources\WhatsApp\Models\InteractiveMultiProductSection;
use Tests\TestCase;
use Infobip\Resources\WhatsApp\Models\ProductRetailerId;
use Infobip\Resources\WhatsApp\WhatsAppInteractiveMultiProductMessageResource;

final class WhatsAppInteractiveMultiProductMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';
        $bulkId = 'bulkId';
        $header = new InteractiveMultiProductTextHeader('text');
        $footer = new InteractiveMultiProductFooter('text');
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $productRetailerIds = new ProductRetailerIdCollection();
        $productRetailerIds->add(new ProductRetailerId('productRetailerId'));

        $section = new InteractiveMultiProductSection();
        $section->setTitle('title');
        $section->addProductRetailerId(new ProductRetailerId('productRetailerId'));

        $body = new InteractiveMultiProductBody('text');

        $action = new InteractiveMultiProductAction('catalogId');
        $action->addInteractiveMultiProductSection((new InteractiveMultiProductSection())->setTitle('title'));

        $content = new InteractiveMultiProductContent($body, $action, $header);
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
        $whatsAppInteractiveMultiProductMessageResource = (new WhatsAppInteractiveMultiProductMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveMultiProductMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $messageId = 'messageId';
        $bulkId = 'bulkId';
        $header = new InteractiveMultiProductTextHeader('text');

        $productRetailerIds = new ProductRetailerIdCollection();
        $productRetailerIds->add(new ProductRetailerId('productRetailerId'));

        $section = new InteractiveMultiProductSection();
        $section->setTitle('title');
        $section->addProductRetailerId(new ProductRetailerId('productRetailerId'));

        $body = new InteractiveMultiProductBody('text');
        $action = new InteractiveMultiProductAction('catalogId');

        $content = new InteractiveMultiProductContent($body, $action, $header);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'messageId' => $messageId,
            'bulkId' => $bulkId,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppInteractiveMultiProductMessageResource = (new WhatsAppInteractiveMultiProductMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveMultiProductMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $header = new InteractiveMultiProductTextHeader('text');

        $productRetailerIds = new ProductRetailerIdCollection();
        $productRetailerIds->add(new ProductRetailerId('productRetailerId'));

        $body = new InteractiveMultiProductBody('text');
        $action = new InteractiveMultiProductAction('catalogId');

        $content = new InteractiveMultiProductContent($body, $action, $header);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppInteractiveMultiProductMessageResource = new WhatsAppInteractiveMultiProductMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppInteractiveMultiProductMessageResource->payload());
    }
}
