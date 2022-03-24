<?php

declare(strict_types=1);

namespace Tests\Endpoints\MMS;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipBadRequestException;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Exceptions\InfobipTooManyRequestException;
use Infobip\Exceptions\InfobipUnauthorizedException;
use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\MMS\Models\ExternallyHostedMedia;
use Infobip\Resources\MMS\SendSingleMMSMessageResource;
use Tests\Endpoints\TestCase;

final class SendSingleMMSMessageTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/MMS/send_single_mms_message_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->MMS()
            ->sendSingleMMSMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/MMS/send_single_mms_message_bad_request.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::BAD_REQUEST,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipBadRequestException::class);
        $this->expectExceptionCode(StatusCode::BAD_REQUEST);
        $this->expectExceptionMessage($mockedResponse['errorMessage']);

        $this
            ->getInfobipClient()
            ->MMS()
            ->sendSingleMMSMessage($resource);
    }

    public function testApiCallExpectsUnauthorizedException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Errors/unauthorized.json');

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
            ->MMS()
            ->sendSingleMMSMessage($resource);
    }

    public function testApiCallExpectsTooManyRequestsException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Errors/too_many_requests.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::TOO_MANY_REQUESTS,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipTooManyRequestException::class);
        $this->expectExceptionCode(StatusCode::TOO_MANY_REQUESTS);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        $this
            ->getInfobipClient()
            ->MMS()
            ->sendSingleMMSMessage($resource);
    }

    public function testApiCallExpectsServerErrorException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Errors/server_error.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SERVER_ERROR,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipServerException::class);
        $this->expectExceptionCode(StatusCode::SERVER_ERROR);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        $this
            ->getInfobipClient()
            ->MMS()
            ->sendSingleMMSMessage($resource);
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
                ->MMS()
                ->sendSingleMMSMessage($resource);
        } catch (InfobipValidationException $exception) {
            $this->assertArrayHasKey('externallyHostedMedia.contentUrl', $exception->getValidationErrors());

            throw $exception;
        }
    }

    private function getResource(): SendSingleMMSMessageResource
    {
        return new SendSingleMMSMessageResource();
    }

    private function getInvalidResource(): SendSingleMMSMessageResource
    {
        return (new SendSingleMMSMessageResource())
            ->setExternallyHostedMedia(new ExternallyHostedMedia(
                'contentType',
                'contentId',
                'invalid url'
            ));
    }
}
