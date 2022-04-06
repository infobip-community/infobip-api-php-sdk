<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use DateTimeImmutable;
use DateTimeInterface;
use Infobip\Resources\SMS\Enums\GeneralStatusType;
use Infobip\Resources\SMS\GetOutboundSMSMessageLogsResource;
use Tests\TestCase;

final class GetOutboundSMSMessageLogsResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $from = 'from';
        $to = 'to';
        $bulkId = ['bulkId1', 'bulkId2'];
        $messageId = 'messageId';
        $generalStatus = new GeneralStatusType(GeneralStatusType::ACCEPTED);
        $sentSince = new DateTimeImmutable();
        $sentUntil = new DateTimeImmutable();
        $limit = 50;
        $mcc = 'mcc';
        $mnc = 'mnc';

        $expectedArray = [
            'from' => $from,
            'to' => $to,
            'bulkId' => $bulkId,
            'messageId' => $messageId,
            'generalStatus' => $generalStatus->getValue(),
            'sentSince' => $sentSince->format(DateTimeInterface::RFC3339_EXTENDED),
            'sentUntil' => $sentUntil->format(DateTimeInterface::RFC3339_EXTENDED),
            'limit' => $limit,
            'mcc' => $mcc,
            'mnc' => $mnc,
        ];

        // act
        $getOutboundSMSMessageLogsResource = (new GetOutboundSMSMessageLogsResource())
            ->setFrom($from)
            ->setTo($to)
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setGeneralStatus($generalStatus)
            ->setSentSince($sentSince)
            ->setSentUntil($sentUntil)
            ->setLimit($limit)
            ->setMcc($mcc)
            ->setMnc($mnc);

        // assert
        $this->assertSame($expectedArray, $getOutboundSMSMessageLogsResource->queryOptions());
    }

    public function testCanCreateResourceWithNoData(): void
    {
        // act
        $getOutboundSMSMessageLogsResource = new GetOutboundSMSMessageLogsResource();

        // assert
        $this->assertSame([], $getOutboundSMSMessageLogsResource->queryOptions());
    }
}
