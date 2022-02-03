<?php

declare(strict_types=1);

namespace Tests\Endpoints\WhatsApp;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipBadRequestException;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Exceptions\InfobipTooManyRequestException;
use Infobip\Exceptions\InfobipUnauthorizedException;
use Infobip\Resources\WhatsApp\Models\ContactContent;
use Infobip\Resources\WhatsApp\WhatsAppContactMessageResource;
use Tests\Endpoints\TestCase;

final class SendWhatsAppContactMessageTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/send_whatsapp_contact_message_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->whatsApp()
            ->sendWhatsAppContactMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/send_whatsapp_contact_message_bad_request.json');

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
            ->sendWhatsAppContactMessage($resource);
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
            ->sendWhatsAppContactMessage($resource);
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
            ->sendWhatsAppContactMessage($resource);
    }

    public function testApiCallExpectsServerException(): void
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
            ->whatsApp()
            ->sendWhatsAppContactMessage($resource);
    }

    private function getResource(): WhatsAppContactMessageResource
    {
        return new WhatsAppContactMessageResource(
            'from',
            'to',
            new ContactContent()
        );
    }
}
