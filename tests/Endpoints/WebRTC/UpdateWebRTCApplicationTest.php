<?php

declare(strict_types=1);

namespace Tests\Endpoints\WebRTC;

use Illuminate\Support\Str;
use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipUnauthorizedException;
use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\WebRTC\UpdateWebRTCApplicationResource;
use Tests\Endpoints\TestCase;

final class UpdateWebRTCApplicationTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WebRTC/update_webrtc_application_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->webRTC()
            ->updateWebRTCApplication($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsUnauthorizedException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WebRTC/update_webrtc_application_unauthorized.json');

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
            ->updateWebRTCApplication($resource);
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
                ->updateWebRTCApplication($resource);
        } catch (InfobipValidationException $exception) {
            $this->assertArrayHasKey('description', $exception->getValidationErrors());

            throw $exception;
        }
    }

    private function getResource(): UpdateWebRTCApplicationResource
    {
        return new UpdateWebRTCApplicationResource(
            'id',
            'name'
        );
    }

    private function getInvalidResource(): UpdateWebRTCApplicationResource
    {
        return (new UpdateWebRTCApplicationResource(
            'id',
            'name'
        ))
            ->setDescription(Str::random(200));
    }
}
