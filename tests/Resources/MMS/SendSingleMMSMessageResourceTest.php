<?php

declare(strict_types=1);

namespace Tests\Resources\MMS;

use DateTimeImmutable;
use Infobip\Resources\MMS\Models\ExternallyHostedMedia;
use Infobip\Resources\MMS\Models\Head;
use Infobip\Resources\MMS\SendSingleMMSMessageResource;
use Infobip\Resources\Shared\Enums\Day;
use Infobip\Resources\Shared\Models\DeliveryTimeWindow;
use Infobip\Resources\Shared\Models\TimeWindowFrom;
use Infobip\Resources\Shared\Models\TimeWindowTo;
use Tests\TestCase;

final class SendSingleMMSMessageResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $timeWindowFrom = new TimeWindowFrom(8, 30);
        $timeWindowTo = new TimeWindowTo(8, 45);
        $deliveryTimeWindow = (new DeliveryTimeWindow())
            ->addDay(new Day(Day::FRIDAY))
            ->addDay(new Day(Day::SATURDAY))
            ->setTimeWindow($timeWindowFrom, $timeWindowTo);

        $head = (new Head('from', 'to'))
            ->setId('id')
            ->setSubject('subject')
            ->setValidityPeriodMinutes(1440)
            ->setCallbackData('callbackData')
            ->setNotifyUrl('notifyUrl')
            ->setSendAt(new DateTimeImmutable())
            ->setIntermediateReport(true)
            ->setDeliveryTimeWindow($deliveryTimeWindow);

        $text = 'text';
        $media = 'media';
        $externallyHostedMedia = new ExternallyHostedMedia('contentType', 'contentId', 'contentUrl');
        $smil = 'smil';

        $expectedArray = [
            'head' => $head->toArray(),
            'text' => $text,
            'media' => $media,
            'externallyHostedMedia' => $externallyHostedMedia->toArray(),
            'smil' => $smil,
        ];

        // act
        $getInboundMMSMessagesResource = (new SendSingleMMSMessageResource())
            ->setHead($head)
            ->setText($text)
            ->setMedia($media)
            ->setExternallyHostedMedia($externallyHostedMedia)
            ->setSmil($smil);

        // assert
        $this->assertSame($expectedArray, $getInboundMMSMessagesResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $text = 'text';
        $media = 'media';
        $externallyHostedMedia = new ExternallyHostedMedia('contentType', 'contentId', 'contentUrl');
        $smil = 'smil';

        $expectedArray = [
            'text' => $text,
            'media' => $media,
            'externallyHostedMedia' => $externallyHostedMedia->toArray(),
            'smil' => $smil,
        ];

        // act
        $getInboundMMSMessagesResource = (new SendSingleMMSMessageResource())
            ->setText($text)
            ->setMedia($media)
            ->setExternallyHostedMedia($externallyHostedMedia)
            ->setSmil($smil);

        // assert
        $this->assertSame($expectedArray, $getInboundMMSMessagesResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $expectedArray = [];

        // act
        $getInboundMMSMessagesResource = new SendSingleMMSMessageResource();

        // assert
        $this->assertSame($expectedArray, $getInboundMMSMessagesResource->payload());
    }
}
