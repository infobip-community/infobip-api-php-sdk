<?php

declare(strict_types=1);

namespace Tests\Resources\WebRTC;

use Infobip\Resources\WebRTC\GetWebRTCApplicationResource;
use Tests\TestCase;

final class GetWebRTCApplicationResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $id = 'id';

        // act
        $getWebRTCApplicationResource = new GetWebRTCApplicationResource(
            $id
        );

        // assert
        $this->assertSame($id, $getWebRTCApplicationResource->getId());
    }
}
