<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\Models\SmsFailover;
use Infobip\Resources\WhatsApp\Models\TemplateBody;
use Infobip\Resources\WhatsApp\Models\TemplateMessage;
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
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $templateName = new TemplateName('templatename');
        $language = new TemplateLanguage('language');
        $templateHeader = new TextTemplateHeader('type');
        $templateButton = new TemplateQuickReplyButton('parameter');

        $body = new TemplateBody();
        $body->addPlaceholder('placeholder');

        $data = (new TemplateData($body))
            ->addTemplateButton($templateButton)
            ->setTemplateHeader($templateHeader);

        $smsFailOver = new SmsFailover('from', 'text');

        $content = new TemplateContent($templateName, $data, $language);

        $messageId = 'messageId';
        $bulkId = 'bulkId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';

        $templateMessage = (new TemplateMessage($from, $to, $content))
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl)
            ->setSmsFailover($smsFailOver);

        $expectedArray = [
            'messages' => [
                $templateMessage->toArray()
            ],
            'bulkId' => $bulkId,
        ];

        // act
        $whatsAppTemplateMessageResource = (new WhatsAppTemplateMessageResource())
            ->setBulkId($bulkId)
            ->addTemplateMessage($templateMessage);

        // assert
        $this->assertSame($expectedArray, $whatsAppTemplateMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $templateName = new TemplateName('templatename');
        $language = new TemplateLanguage('language');

        $bulkId = 'bulkId';

        $body = new TemplateBody();
        $body->addPlaceholder('placeholder');

        $data = (new TemplateData($body));

        $content = new TemplateContent($templateName, $data, $language);

        $templateMessage = (new TemplateMessage($from, $to, $content));

        $expectedArray = [
            'messages' => [
                [
                    'from' => $from,
                    'to' => $to,
                    'content' => $content->toArray(),
                ],
            ],
            'bulkId' => $bulkId,
        ];

        // act
        $whatsAppTemplateMessageResource = (new WhatsAppTemplateMessageResource())
            ->setBulkId($bulkId)
            ->addTemplateMessage($templateMessage);

        // assert
        $this->assertSame($expectedArray, $whatsAppTemplateMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $templateName = new TemplateName('templatename');
        $language = new TemplateLanguage('language');

        $body = new TemplateBody();
        $body->addPlaceholder('placeholder');

        $data = (new TemplateData($body));

        $content = new TemplateContent($templateName, $data, $language);

        $templateMessage = (new TemplateMessage($from, $to, $content));

        $expectedArray = [
            'messages' => [
                [
                    'from' => $from,
                    'to' => $to,
                    'content' => $content->toArray(),
                ],
            ]
        ];

        // act
        $whatsAppTemplateMessageResource = (new WhatsAppTemplateMessageResource())
            ->addTemplateMessage($templateMessage);

        // assert
        $this->assertSame($expectedArray, $whatsAppTemplateMessageResource->payload());
    }
}
