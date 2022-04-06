<?php

declare(strict_types=1);

namespace Tests\Resources\RCS;

use Infobip\Resources\RCS\Enums\CardWidth;
use Infobip\Resources\RCS\Enums\ValidityPeriodTimeUnit;
use Infobip\Resources\RCS\Models\CarouselContent;
use Infobip\Resources\RCS\Models\CarouselMessageContent;
use Infobip\Resources\RCS\Models\SMSFailover;
use Infobip\Resources\RCS\RCSBulkMessageResource;
use Tests\TestCase;

final class RCSBulkMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
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
        $content = new CarouselMessageContent(new CardWidth(CardWidth::SMALL));

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'validityPeriod' => $validityPeriod,
            'validityPeriodTimeUnit' => $validityPeriodTimeUnit->getValue(),
            'content' => $content,
            'smsFailover' => $smsFailover->toArray(),
            'notifyUrl' => $notifyUrl,
            'callbackData' => $callbackData,
            'messageId' => $messageId,
        ];

        // act
        $RCSBulkMessageResource = (new RCSBulkMessageResource(
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
        $this->assertSame($expectedArray, $RCSBulkMessageResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $validityPeriod = 25;
        $messageId = 'messageId';
        $callbackData = 'callbackData';
        $notifyUrl = 'notifyUrl';
        $content = new CarouselMessageContent(new CardWidth(CardWidth::SMALL));

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
        $RCSBulkMessageResource = (new RCSBulkMessageResource(
            $to,
            $content
        ))
            ->setFrom($from)
            ->setValidityPeriod($validityPeriod)
            ->setMessageId($messageId)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl);

        // assert
        $this->assertSame($expectedArray, $RCSBulkMessageResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $to = 'to';
        $content = new CarouselMessageContent(new CardWidth(CardWidth::SMALL));

        $expectedArray = [
            'to' => $to,
            'content' => $content,
        ];

        // act
        $RCSBulkMessageResource = new RCSBulkMessageResource(
            $to,
            $content
        );

        // assert
        $this->assertSame($expectedArray, $RCSBulkMessageResource->payload());
    }
}
