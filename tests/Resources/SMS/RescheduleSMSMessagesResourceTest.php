<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\RescheduleSMSMessagesResource;
use Tests\TestCase;

final class RescheduleSMSMessagesResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $bulkId = 'bulkId';
        $sendAt = 'sendAt';

        $expectedQueryOptionsArray = [
            'bulkId' => $bulkId
        ];

        $expectedPayloadArray = [
            'sendAt' => $sendAt
        ];

        // act
        $rescheduleSMSMessagesResource = new RescheduleSMSMessagesResource($bulkId, $sendAt);

        // assert
        $this->assertSame($expectedPayloadArray, $rescheduleSMSMessagesResource->payload());
        $this->assertSame($expectedQueryOptionsArray, $rescheduleSMSMessagesResource->queryOptions());
    }
}
