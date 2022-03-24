<?php

declare(strict_types=1);

namespace Tests\Endpoints\WebRTC;

use Illuminate\Support\Str;
use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipUnauthorizedException;
use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\WebRTC\SaveWebRTCApplicationResource;
use Tests\Endpoints\TestCase;

final class SaveWebRTCApplicationTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WebRTC/save_webrtc_application_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->webRTC()
            ->saveWebRTCApplication($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsUnauthorizedException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WebRTC/save_webrtc_application_unauthorized.json');

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
            ->saveWebRTCApplication($resource);
    }

    public function testApiCallExpectsValidationException(): void
    {
        // arrange
        $resource = $this->getInvalidResource();

        $this->setMockedGuzzleHttpClient(StatusCode::NO_CONTENT);

        // act & assert
        $this->expectException(InfobipValidationException::class);
        $this->expectExceptionCode(StatusCode::UNPROCESSABLE_ENTITY);

        try {
            $this
                ->getInfobipClient()
                ->webRTC()
                ->saveWebRTCApplication($resource);
        } catch (InfobipValidationException $exception) {
            $this->assertArrayHasKey('description', $exception->getValidationErrors());

            throw $exception;
        }
    }

    private function getResource(): SaveWebRTCApplicationResource
    {
        return new SaveWebRTCApplicationResource(
            'name'
        );
    }

    private function getInvalidResource(): SaveWebRTCApplicationResource
    {
        return (new SaveWebRTCApplicationResource(
            'name'
        ))
            ->setDescription(Str::random(200));
    }
}
