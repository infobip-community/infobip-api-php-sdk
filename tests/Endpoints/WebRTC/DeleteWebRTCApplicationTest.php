<?php

declare(strict_types=1);

namespace Tests\Endpoints\WebRTC;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipUnauthorizedException;
use Infobip\Resources\WebRTC\DeleteWebRTCApplicationResource;
use Tests\Endpoints\TestCase;

final class DeleteWebRTCApplicationTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            []
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->webRTC()
            ->deleteWebRTCApplication($resource);

        // assert
        $this->assertSame([], $response);
    }

    public function testApiCallExpectsSuccessNoContent(): void
    {
        // arrange
        $resource = $this->getResource();

        $this->setMockedGuzzleHttpClient(
            StatusCode::NO_CONTENT,
            []
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->webRTC()
            ->deleteWebRTCApplication($resource);

        // assert
        $this->assertSame([], $response);
    }

    public function testApiCallExpectsUnauthorizedException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WebRTC/delete_webrtc_application_unauthorized.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::UNAUTHORIZED,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipUnauthorizedException::class);
        $this->expectExceptionCode(StatusCode::UNAUTHORIZED);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        $this
            ->getInfobipClient()
            ->webRTC()
            ->deleteWebRTCApplication($resource);
    }

    private function getResource(): DeleteWebRTCApplicationResource
    {
        return new DeleteWebRTCApplicationResource(
            'id'
        );
    }
}
