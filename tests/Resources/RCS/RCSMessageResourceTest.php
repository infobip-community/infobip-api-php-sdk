<?php

declare(strict_types=1);

namespace Tests\Resources\RCS;

use Infobip\Resources\RCS\Enums\CardWidth;
use Infobip\Resources\RCS\Enums\ValidityPeriodTimeUnit;
use Infobip\Resources\RCS\Models\CarouselContent;
use Infobip\Resources\RCS\Models\CarouselMessageContent;
use Infobip\Resources\RCS\Models\SMSFailover;
use Infobip\Resources\RCS\RCSMessageResource;
use Infobip\Resources\WhatsApp\Models\AudioContent;
use Infobip\Resources\WhatsApp\WhatsAppAudioMessageResource;
use Tests\TestCase;

final class RCSMessageResourceTest extends TestCase
{
    public function testCanCreateRCSMessageResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $validityPeriod = 25;
        $validityPeriodTimeUnit = new ValidityPeriodTimeUnit(ValidityPeriodTimeUnit::MINUTES);
        $smsFailover = new SMSFailover('from', 'text');
        $notifyUrl = 'notifyUrl';
        $callbackData = 'callbackData';
        $messageId = 'messageId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';
        $content = new CarouselMessageContent(
            new CardWidth(CardWidth::SMALL),
            new CarouselContent()
        );

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'validityPeriod' => $validityPeriod,
            'validityPeriodTimeUnit' => $validityPeriodTimeUnit,
            'content' => $content,
            'smsFailover' => $smsFailover,
            'notifyUrl' => $notifyUrl,
            'callbackData' => $callbackData,
            'messageId' => $messageId,
        ];

        // act
        $RCSMessageResource = (new RCSMessageResource(
            $to,
            $content
        ))
            ->setFrom($from)
            ->setValidityPeriod($validityPeriod)
            ->setValidityPeriodTimeUnit($validityPeriodTimeUnit)
            ->setSmsFailover($smsFailover)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $RCSMessageResource->payload());
    }

    public function testCanCreateRCSMessageResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $validityPeriod = 25;
        $messageId = 'messageId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';
        $content = new CarouselMessageContent(
            new CardWidth(CardWidth::SMALL),
            new CarouselContent()
        );

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'validityPeriod' => $validityPeriod,
            'content' => $content,
            'notifyUrl' => $notifyUrl,
            'callbackData' => $callbackData,
            'messageId' => $messageId,
        ];

        // act
        $RCSMessageResource = (new RCSMessageResource(
            $to,
            $content
        ))
            ->setFrom($from)
            ->setValidityPeriod($validityPeriod)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $RCSMessageResource->payload());
    }

    public function testCanCreateRCSMessageResourceWithRequiredData(): void
    {
        // arrange
        $to = 'to';
        $content = new CarouselMessageContent(
            new CardWidth(CardWidth::SMALL),
            new CarouselContent()
        );

        $expectedArray = [
            'to' => $to,
            'content' => $content,
        ];

        // act
        $RCSMessageResource = new RCSMessageResource(
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $RCSMessageResource->payload());
    }
}
