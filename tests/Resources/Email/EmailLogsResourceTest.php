<?php

declare(strict_types=1);

namespace Tests\Resources\Email;

use Infobip\Resources\Email\EmailLogsResource;
use Tests\TestCase;

final class EmailLogsResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $messageId = 'messageId';
        $from = 'from';
        $to = 'to';
        $bulkId = 'bulkId';
        $generalStatus = 'generalStatus';
        $sentSince = 'sentSince';
        $sentUntil = 'sentUntil';
        $limit = 10;

        $expectedArray = [
            'messageId' => $messageId,
            'from' => $from,
            'to' => $to,
            'bulkId' => $bulkId,
            'generalStatus' => $generalStatus,
            'sentSince' => $sentSince,
            'sentUntil' => $sentUntil,
            'limit' => $limit,
        ];

        // act
        $resource = (new EmailLogsResource())
            ->setMessageId($messageId)
            ->setFrom($from)
            ->setTo($to)
            ->setBulkId($bulkId)
            ->setGeneralStatus($generalStatus)
            ->setSentSince($sentSince)
            ->setSentUntil($sentUntil)
            ->setLimit($limit);

        // assert
        $this->assertSame($expectedArray, $resource->queryOptions());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $expectedArray = [];

        // act
        $resource = new EmailLogsResource();

        // assert
        $this->assertSame($expectedArray, $resource->queryOptions());
    }
}
