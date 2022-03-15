<?php

declare(strict_types=1);

namespace Tests\Endpoints\WebRTC;

use Infobip\Enums\StatusCode;
use Infobip\Resources\WebRTC\GenerateWebRTCTokenResource;
use Tests\Endpoints\TestCase;

final class GenerateWebRTCTokenTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WebRTC/generate_webrtc_token_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->webRTC()
            ->generateWebRTCToken($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): GenerateWebRTCTokenResource
    {
        return new GenerateWebRTCTokenResource(
            'sender'
        );
    }
}
