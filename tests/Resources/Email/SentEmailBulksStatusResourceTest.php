<?php

declare(strict_types=1);

namespace Tests\Resources\Email;

use Infobip\Resources\Email\SentEmailBulksStatusResource;
use Tests\TestCase;

final class SentEmailBulksStatusResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $bulkId = 'bulkId';

        $expectedArray = [
            'bulkId' => $bulkId,
        ];

        // act
        $resource = new SentEmailBulksStatusResource($bulkId);

        // assert
        $this->assertSame($expectedArray, $resource->queryOptions());
    }
}
