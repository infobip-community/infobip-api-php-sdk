<?php

declare(strict_types=1);

namespace Tests\Resources\Email;

use Infobip\Resources\Email\FullyFeaturedEmailResource;
use Tests\TestCase;

final class FullyFeaturedEmailResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $cc = 'cc';
        $bcc = 'bcc';
        $subject = 'subject';
        $text = 'text';
        $bulkId = 'bulkId';
        $messageId = 'messageId';
        $templateId = 1;
        $attachment = 'attachment';
        $inlineImage = 'inlineImage';
        $html = 'html';
        $replyTo = 'replyTo';
        $defaultPlaceholders = 'defaultPlaceholders';
        $trackingUrl = 'trackingUrl';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';
        $notifyContentType = 'notifyContentType';
        $sendAt = 'sendAt';
        $landingPagePlaceholders = 'landingPagePlaceholders';
        $landingPageId = 'landingPageId';

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'cc' => $cc,
            'bcc' => $bcc,
            'subject' => $subject,
            'text' => $text,
            'bulkId' => $bulkId,
            'messageId' => $messageId,
            'templateid' => $templateId,
            'attachment' => $attachment,
            'inlineImage' => $inlineImage,
            'HTML' => $html,
            'replyto' => $replyTo,
            'defaultplaceholders' => $defaultPlaceholders,
            'preserverecipients' => true,
            'trackingUrl' => $trackingUrl,
            'trackclicks' => true,
            'trackopens' => true,
            'track' => true,
            'callbackData' => $callbackData,
            'intermediateReport' => true,
            'notifyUrl' => $notifyUrl,
            'notifyContentType' => $notifyContentType,
            'sendAt' => $sendAt,
            'landingPagePlaceholders' => $landingPagePlaceholders,
            'landingPageId' => $landingPageId,
        ];

        // act
        $resource = (new FullyFeaturedEmailResource($from, $to, $subject))
            ->setCc($cc)
            ->setBcc($bcc)
            ->setText($text)
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setTemplateId($templateId)
            ->setAttachment($attachment)
            ->setInlineImage($inlineImage)
            ->setHtml($html)
            ->setReplyTo($replyTo)
            ->setDefaultPlaceholders($defaultPlaceholders)
            ->setTrackingUrl($trackingUrl)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl)
            ->setNotifyContentType($notifyContentType)
            ->setSendAt($sendAt)
            ->setLandingPagePlaceholders($landingPagePlaceholders)
            ->setLandingPageId($landingPageId)
            ->enablePreserveRecipients()
            ->enableIntermediateReport()
            ->enableTrack()
            ->enableTrackClicks()
            ->enableTrackOpens();

        // assert
        $this->assertSame($expectedArray, $resource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $subject = 'subject';

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
            'preserverecipients' => false,
            'trackclicks' => false,
            'trackopens' => false,
            'track' => false,
            'intermediateReport' => false,
        ];

        // act
        $resource = new FullyFeaturedEmailResource($from, $to, $subject);

        // assert
        $this->assertSame($expectedArray, $resource->payload());
    }
}
