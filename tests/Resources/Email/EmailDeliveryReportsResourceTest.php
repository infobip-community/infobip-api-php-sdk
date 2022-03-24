<?php

declare(strict_types=1);

namespace Tests\Resources\Email;

use Infobip\Resources\Email\EmailDeliveryReportsResource;
use Tests\TestCase;

final class EmailDeliveryReportsResourceTest extends TestCase
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
        $resource = (new EmailDeliveryReportsResource())
            ->setBulkId($bulkId)
            ->setMessageId($messageId)
            ->setLimit($limit);

        // assert
        $this->assertSame($expectedArray, $resource->queryOptions());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $expectedArray = [];

        // act
        $resource = new EmailDeliveryReportsResource();

        // assert
        $this->assertSame($expectedArray, $resource->queryOptions());
    }
}
