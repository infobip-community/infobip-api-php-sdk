<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\GetScheduledSMSMessagesResource;
use Tests\TestCase;

final class GetScheduledSMSMessagesResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $expectedArray = [
            'bulkId' => 'bulkId'
        ];

        // act
        $getScheduledSMSMessagesResource = new GetScheduledSMSMessagesResource('bulkId');

        // assert
        $this->assertSame($expectedArray, $getScheduledSMSMessagesResource->queryOptions());
    }
}
