<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\GetScheduledSMSMessagesStatusResource;
use Tests\TestCase;

final class GetScheduledSMSMessagesStatusResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $expectedArray = [
            'bulkId' => 'bulkId'
        ];

        // act
        $getScheduledSMSMessagesStatusResource = new GetScheduledSMSMessagesStatusResource('bulkId');

        // assert
        $this->assertSame($expectedArray, $getScheduledSMSMessagesStatusResource->queryOptions());
    }
}
