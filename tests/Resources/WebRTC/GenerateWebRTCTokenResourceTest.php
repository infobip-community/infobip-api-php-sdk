<?php

declare(strict_types=1);

namespace Tests\Resources\WebRTC;

use Infobip\Resources\WebRTC\Enums\Recording;
use Infobip\Resources\WebRTC\GenerateWebRTCTokenResource;
use Infobip\Resources\WebRTC\Models\Capabilities;
use Tests\TestCase;

final class GenerateWebRTCTokenResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $identity = 'identity';
        $applicationId = 'applicationId';
        $displayName = 'displayName';
        $capabilities = new Capabilities();
        $capabilities->setRecording(new Recording('ALWAYS'));
        $timeToLive = 15;

        $expectedArray = [
            'identity' => $identity,
            'applicationId' => $applicationId,
            'displayName' => $displayName,
            'capabilities' => $capabilities->toArray(),
            'timeToLive' => $timeToLive,
        ];

        // act
        $generateWebRTCTokenResource = (new GenerateWebRTCTokenResource(
            $identity
        ))
            ->setApplicationId($applicationId)
            ->setDisplayName($displayName)
            ->setCapabilities($capabilities)
            ->setTimeToLive($timeToLive);

        // assert
        $this->assertSame($expectedArray, $generateWebRTCTokenResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $identity = 'identity';
        $displayName = 'displayName';

        $expectedArray = [
            'identity' => $identity,
            'displayName' => $displayName
        ];

        // act
        $generateWebRTCTokenResource = (new GenerateWebRTCTokenResource($identity))
            ->setDisplayName($displayName);

        // assert
        $this->assertSame($expectedArray, $generateWebRTCTokenResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $identity = 'identity';

        $expectedArray = [
            'identity' => $identity
        ];

        // act
        $generateWebRTCTokenResource = new GenerateWebRTCTokenResource($identity);

        // assert
        $this->assertSame($expectedArray, $generateWebRTCTokenResource->payload());
    }
}
