<?php

declare(strict_types=1);

namespace Tests\Resources\Email;

use Infobip\Resources\Email\SentEmailBulksResource;
use Tests\TestCase;

final class SentEmailBulksResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $bulkId = 'bulkId';

        $expectedArray = [
            'bulkId' => $bulkId,
        ];

        // act
        $resource = new SentEmailBulksResource($bulkId);

        // assert
        $this->assertSame($expectedArray, $resource->queryOptions());
    }
}
