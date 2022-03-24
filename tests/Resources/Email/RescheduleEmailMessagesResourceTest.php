<?php

declare(strict_types=1);

namespace Tests\Resources\Email;

use Infobip\Resources\Email\RescheduleEmailMessagesResource;
use Tests\TestCase;

final class RescheduleEmailMessagesResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $bulkId = 'bulkId';
        $sendAt = 'sendAt';

        $expectedQueryOptionArray = [
            'bulkId' => $bulkId,
        ];

        $expectedPayloadArray = [
            'sendAt' => $sendAt,
        ];

        // act
        $resource = new RescheduleEmailMessagesResource($bulkId, $sendAt);

        // assert
        $this->assertSame($expectedQueryOptionArray, $resource->queryOptions());
        $this->assertSame($expectedPayloadArray, $resource->payload());
    }
}
