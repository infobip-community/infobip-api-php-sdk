<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use DateTimeImmutable;
use DateTimeInterface;
use Infobip\Resources\SMS\RescheduleSMSMessagesResource;
use Tests\TestCase;

final class RescheduleSMSMessagesResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $bulkId = 'bulkId';
        $sendAt = new DateTimeImmutable();

        $expectedQueryOptionsArray = [
            'bulkId' => $bulkId
        ];

        $expectedPayloadArray = [
            'sendAt' => $sendAt->format(DateTimeInterface::RFC3339_EXTENDED)
        ];

        // act
        $rescheduleSMSMessagesResource = new RescheduleSMSMessagesResource($bulkId, $sendAt);

        // assert
        $this->assertSame($expectedPayloadArray, $rescheduleSMSMessagesResource->payload());
        $this->assertSame($expectedQueryOptionsArray, $rescheduleSMSMessagesResource->queryOptions());
    }
}
