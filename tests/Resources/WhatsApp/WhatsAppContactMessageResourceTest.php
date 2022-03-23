<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Collections\ContactCollection;
use Infobip\Resources\WhatsApp\Models\Contact;
use Infobip\Resources\WhatsApp\Models\ContactContent;
use Infobip\Resources\WhatsApp\Models\Name;
use Infobip\Resources\WhatsApp\WhatsAppContactMessageResource;
use Tests\TestCase;

final class WhatsAppContactMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';

        $contact = new Contact(new Name('First name', 'Formatted name'));

        $content = new ContactContent();
        $content->addContact($contact);
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
        $whatsAppContactMessageResource = (new WhatsAppContactMessageResource(
            $from,
            $to,
            $content
        ))
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppContactMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';

        $contact = new Contact(new Name('First name', 'Formatted name'));

        $content = new ContactContent();
        $content->addContact($contact);
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
            'callbackData' => $callbackData,
            'notifyUrl' => $notifyUrl,
        ];

        // act
        $whatsAppContactMessageResource = (new WhatsAppContactMessageResource(
            $from,
            $to,
            $content
        ))
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppContactMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        $from = 'from';
        $to = 'to';

        $contact = new Contact(new Name('First name', 'Formatted name'));
        $content = new ContactContent();
        $content->addContact($contact);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppContactMessageResource = new WhatsAppContactMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppContactMessageResource->payload());
    }
}
