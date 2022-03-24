<?php

declare(strict_types=1);

namespace Tests\Endpoints\WebRTC;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipValidationException;
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
                ->generateWebRTCToken($resource);
        } catch (InfobipValidationException $exception) {
            $this->assertArrayHasKey('identity', $exception->getValidationErrors());
            $this->assertArrayHasKey('displayName', $exception->getValidationErrors());

            throw $exception;
        }
    }

    private function getResource(): GenerateWebRTCTokenResource
    {
        return new GenerateWebRTCTokenResource(
            'sender'
        );
    }

    private function getInvalidResource(): GenerateWebRTCTokenResource
    {
        return (new GenerateWebRTCTokenResource(
            'a'
        ))
            ->setDisplayName('b');
    }
}
