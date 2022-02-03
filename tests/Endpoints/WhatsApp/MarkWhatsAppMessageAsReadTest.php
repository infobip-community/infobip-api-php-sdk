<?php

declare(strict_types=1);

namespace Tests\Endpoints\WhatsApp;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipBadRequestException;
use Infobip\Exceptions\InfobipForbiddenException;
use Infobip\Resources\WhatsApp\WhatsAppMarkAsReadResource;
use Tests\Endpoints\TestCase;

final class MarkWhatsAppMessageAsReadTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
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
            ->whatsApp()
            ->markWhatsAppMessageAsRead($resource);

        // assert
        $this->assertSame([], $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/mark_whatsapp_message_as_read_bad_request.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::BAD_REQUEST,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipBadRequestException::class);
        $this->expectExceptionCode(StatusCode::BAD_REQUEST);

        $this
            ->getInfobipClient()
            ->whatsApp()
            ->markWhatsAppMessageAsRead($resource);
    }

    public function testApiCallExpectsForbiddenException(): void
    {
        // arrange
        $resource = $this->getResource();

        $this->setMockedGuzzleHttpClient(
            StatusCode::FORBIDDEN,
            []
        );

        // act & assert
        $this->expectException(InfobipForbiddenException::class);
        $this->expectExceptionCode(StatusCode::FORBIDDEN);

        $this
            ->getInfobipClient()
            ->whatsApp()
            ->markWhatsAppMessageAsRead($resource);
    }

    private function getResource(): WhatsAppMarkAsReadResource
    {
        return new WhatsAppMarkAsReadResource(
            'sender',
            'messageId'
        );
    }
}
