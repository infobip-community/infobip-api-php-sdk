<?php

declare(strict_types=1);

namespace Tests\Endpoints\WebRTC;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipUnauthorizedException;
use Tests\Endpoints\TestCase;

final class GetWebRTCApplicationsTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WebRTC/get_webrtc_applications_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->webRTC()
            ->getWebRTCApplications();

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsUnauthorizedException(): void
    {
        // arrange
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WebRTC/get_webrtc_applications_unauthorized.json');

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
            ->getWebRTCApplications();
    }
}
