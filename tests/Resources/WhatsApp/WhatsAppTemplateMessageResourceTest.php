<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\TemplateBody;
use Infobip\Resources\WhatsApp\Models\TemplateQuickReplyButton;
use Infobip\Resources\WhatsApp\Models\TemplateContent;
use Infobip\Resources\WhatsApp\Models\TemplateData;
use Infobip\Resources\WhatsApp\Models\TextTemplateHeader;
use Infobip\Resources\WhatsApp\Models\TemplateLanguage;
use Infobip\Resources\WhatsApp\Models\TemplateName;
use Infobip\Resources\WhatsApp\WhatsAppTemplateMessageResource;
use Tests\TestCase;

final class WhatsAppTemplateMessageResourceTest extends TestCase
{
    public function testCanCreateWhatsAppTemplateMessageResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $templateName = new TemplateName('templatename');
        $language = new TemplateLanguage('language');
        $templateHeader = new TextTemplateHeader('type');
        $templateButton = new TemplateQuickReplyButton('parameter');

        $body = new TemplateBody();
        $body->addTemplateButton($templateButton);
        $body->setTemplateHeader($templateHeader);
        $body->addPlaceholder('placeholder');

        $data = new TemplateData($body);

        $content = new TemplateContent($templateName, $data, $language);

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
        $whatsAppTemplateMessageResource = (new WhatsAppTemplateMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $whatsAppTemplateMessageResource->payload());
    }

    public function testCanCreateWhatsAppTemplateMessageResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $templateName = new TemplateName('templatename');
        $language = new TemplateLanguage('language');

        $body = new TemplateBody();

        $data = new TemplateData($body);

        $content = new TemplateContent($templateName, $data, $language);

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
        $whatsAppTemplateMessageResource = (new WhatsAppTemplateMessageResource(
            $from,
            $to,
            $content
        ))
            ->setBulkId($bulkId)
            ->setMessageId($messageId);

        // assert
        $this->assertSame($expectedArray, $whatsAppTemplateMessageResource->payload());
    }

    public function testCanCreateWhatsAppContactMessageResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $templateName = new TemplateName('templatename');
        $language = new TemplateLanguage('language');
        $body = new TemplateBody();
        $data = new TemplateData($body);

        $content = new TemplateContent($templateName, $data, $language);

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'content' => $content->toArray(),
        ];

        // act
        $whatsAppTemplateMessageResource = new WhatsAppTemplateMessageResource(
            $from,
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $whatsAppTemplateMessageResource->payload());
    }
}
