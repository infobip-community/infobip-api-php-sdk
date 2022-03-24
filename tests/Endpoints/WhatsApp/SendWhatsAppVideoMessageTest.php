<?php

declare(strict_types=1);

namespace Tests\Endpoints\WhatsApp;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipBadRequestException;
use Infobip\Exceptions\InfobipTooManyRequestException;
use Infobip\Exceptions\InfobipUnauthorizedException;
use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\WhatsApp\Models\VideoContent;
use Infobip\Resources\WhatsApp\WhatsAppVideoMessageResource;
use Tests\Endpoints\TestCase;

final class SendWhatsAppVideoMessageTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/send_whatsapp_video_message_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->whatsApp()
            ->sendWhatsAppVideoMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/send_whatsapp_video_message_bad_request.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::BAD_REQUEST,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipBadRequestException::class);
        $this->expectExceptionCode(StatusCode::BAD_REQUEST);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        $this
            ->getInfobipClient()
            ->whatsApp()
            ->sendWhatsAppVideoMessage($resource);
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
            ->whatsApp()
            ->sendWhatsAppVideoMessage($resource);
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
            ->whatsApp()
            ->sendWhatsAppVideoMessage($resource);
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
                ->whatsApp()
                ->sendWhatsAppVideoMessage($resource);
        } catch (InfobipValidationException $exception) {
            $this->assertArrayHasKey('from', $exception->getValidationErrors());
            $this->assertArrayHasKey('to', $exception->getValidationErrors());
            $this->assertArrayHasKey('content.mediaUrl', $exception->getValidationErrors());

            throw $exception;
        }
    }

    private function getResource(): WhatsAppVideoMessageResource
    {
        return new WhatsAppVideoMessageResource(
            'from',
            'to',
            new VideoContent('https://infobip.com/api/docs')
        );
    }

    private function getInvalidResource(): WhatsAppVideoMessageResource
    {
        return new WhatsAppVideoMessageResource(
            '',
            '',
            new VideoContent('invalid url')
        );
    }
}
