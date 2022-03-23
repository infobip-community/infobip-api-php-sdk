<?php

declare(strict_types=1);

namespace Tests\Resources\WebRTC;

use Infobip\Resources\WebRTC\DeleteWebRTCApplicationResource;
use Tests\TestCase;

final class DeleteWebRTCApplicationResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $id = 'id';

        // act
        $deleteWebRTCApplicationResource = new DeleteWebRTCApplicationResource(
            $id
        );

        // assert
        $this->assertSame($id, $deleteWebRTCApplicationResource->getId());
    }
}
