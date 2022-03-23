<?php

declare(strict_types=1);

namespace Tests\Resources\MMS;

use Infobip\Resources\MMS\GetOutboundMMSMessageDeliveryReportsResource;
use Tests\TestCase;

final class GetOutboundMMSMessageDeliveryReportsResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $bulkId = 'bulkId';
        $messageId = 'messageId';
        $limit = 10;

        $expectedArray = [
            'bulkId' => $bulkId,
            'messageId' => $messageId,
            'limit' => $limit,
        ];

        // act
        $getInboundMMSMessagesResource = (new GetOutboundMMSMessageDeliveryReportsResource())
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setLimit($limit);

        // assert
        $this->assertSame($expectedArray, $getInboundMMSMessagesResource->queryOptions());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $messageId = 'messageId';
        $limit = 10;

        $expectedArray = [
            'messageId' => $messageId,
            'limit' => $limit,
        ];

        // act
        $getInboundMMSMessagesResource = (new GetOutboundMMSMessageDeliveryReportsResource())
            ->setMessageId($messageId)
            ->setLimit($limit);

        // assert
        $this->assertSame($expectedArray, $getInboundMMSMessagesResource->queryOptions());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $expectedArray = [];

        // act
        $getInboundMMSMessagesResource = new GetOutboundMMSMessageDeliveryReportsResource();

        // assert
        $this->assertSame($expectedArray, $getInboundMMSMessagesResource->queryOptions());
    }
}
