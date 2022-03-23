<?php

declare(strict_types=1);

namespace Tests\Resources\MMS;

use Infobip\Resources\MMS\GetInboundMMSMessagesResource;
use Tests\TestCase;

final class GetInboundMMSMessagesResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $limit = 10;

        $expectedArray = [
            'limit' => $limit,
        ];

        // act
        $getInboundMMSMessagesResource = (new GetInboundMMSMessagesResource())
            ->setLimit($limit);

        // assert
        $this->assertSame($expectedArray, $getInboundMMSMessagesResource->queryOptions());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $expectedArray = [];

        // act
        $getInboundMMSMessagesResource = new GetInboundMMSMessagesResource();

        // assert
        $this->assertSame($expectedArray, $getInboundMMSMessagesResource->queryOptions());
    }
}
