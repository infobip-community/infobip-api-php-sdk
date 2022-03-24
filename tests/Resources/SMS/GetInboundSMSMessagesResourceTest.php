<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\GetInboundSMSMessagesResource;
use Tests\TestCase;

final class GetInboundSMSMessagesResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $expectedArray = [
            'limit' => 50
        ];

        // act
        $getInboundSMSMessagesResource = (new GetInboundSMSMessagesResource())
            ->setLimit(50);

        // assert
        $this->assertSame($expectedArray, $getInboundSMSMessagesResource->queryOptions());
    }

    public function testCanCreateResourceWithNoData(): void
    {
        // act
        $getInboundSMSMessagesResource = new GetInboundSMSMessagesResource();

        // assert
        $this->assertSame([], $getInboundSMSMessagesResource->queryOptions());
    }
}
