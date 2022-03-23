<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Enums\StatusType;
use Infobip\Resources\SMS\UpdateScheduledSMSMessagesStatusResource;
use Tests\TestCase;

final class UpdateScheduledSMSMessagesStatusResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $bulkId = 'bulkId';
        $status = new StatusType(StatusType::PENDING);

        $expectedQueryOptionsArray = [
            'bulkId' => $bulkId
        ];

        $expectedPayloadArray = [
            'status' => $status->getValue()
        ];

        // act
        $updateScheduledSMSMessagesStatusResource = new UpdateScheduledSMSMessagesStatusResource($bulkId, $status);

        // assert
        $this->assertSame($expectedPayloadArray, $updateScheduledSMSMessagesStatusResource->payload());
        $this->assertSame($expectedQueryOptionsArray, $updateScheduledSMSMessagesStatusResource->queryOptions());
    }
}
