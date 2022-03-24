<?php

declare(strict_types=1);

namespace Tests\Resources\Email;

use Infobip\Resources\Email\ValidateEmailAddressesResource;
use Tests\TestCase;

final class ValidateEmailAddressesResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $to = 'to';

        $expectedArray = [
            'to' => $to,
        ];

        // act
        $resource = new ValidateEmailAddressesResource($to);

        // assert
        $this->assertSame($expectedArray, $resource->payload());
    }
}
