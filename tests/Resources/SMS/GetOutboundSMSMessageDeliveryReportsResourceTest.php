<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\GetOutboundSMSMessageDeliveryReportsResource;
use Tests\TestCase;

final class GetOutboundSMSMessageDeliveryReportsResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $bulkId = 'bulkId';
        $messageId = 'messageId';
        $limit = 50;

        $expectedArray = [
            'bulkId' => $bulkId,
            'messageId' => $messageId,
            'limit' => $limit
        ];

        // act
        $getOutboundSMSMessageDeliveryReportsResource = (new GetOutboundSMSMessageDeliveryReportsResource())
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setLimit($limit);

        // assert
        $this->assertSame($expectedArray, $getOutboundSMSMessageDeliveryReportsResource->queryOptions());
    }

    public function testCanCreateResourceWithNoData(): void
    {
        // act
        $getOutboundSMSMessageDeliveryReportsResource = new GetOutboundSMSMessageDeliveryReportsResource();

        // assert
        $this->assertSame([], $getOutboundSMSMessageDeliveryReportsResource->queryOptions());
    }
}
