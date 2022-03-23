<?php

declare(strict_types=1);

namespace Tests\Resources\Email;

use Infobip\Resources\Email\Enums\Status;
use Infobip\Resources\Email\UpdateScheduledEmailMessagesStatusResource;
use Tests\TestCase;

final class UpdateScheduledEmailMessagesStatusResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $bulkId = 'bulkId';
        $status = new Status(Status::PENDING);

        $expectedQueryOptionArray = [
            'bulkId' => $bulkId,
        ];

        $expectedPayloadArray = [
            'status' => $status->getValue(),
        ];

        // act
        $resource = new UpdateScheduledEmailMessagesStatusResource($bulkId, $status);

        // assert
        $this->assertSame($expectedQueryOptionArray, $resource->queryOptions());
        $this->assertSame($expectedPayloadArray, $resource->payload());
    }
}
