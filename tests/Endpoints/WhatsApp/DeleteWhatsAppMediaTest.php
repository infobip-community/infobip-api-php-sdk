<?php

declare(strict_types=1);

namespace Tests\Endpoints\WhatsApp;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipForbiddenException;
use Infobip\Exceptions\InfobipNotFoundException;
use Infobip\Resources\WhatsApp\WhatsAppDeleteMediaResource;
use Tests\Endpoints\TestCase;

final class DeleteWhatsAppMediaTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/delete_whatsapp_media_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->whatsApp()
            ->deleteWhatsAppMedia($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
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
            ->deleteWhatsAppMedia($resource);
    }

    public function testApiCallExpectsNotFoundException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/delete_whatsapp_media_not_found.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::NOT_FOUND,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipNotFoundException::class);
        $this->expectExceptionCode(StatusCode::NOT_FOUND);

        $this
            ->getInfobipClient()
            ->whatsApp()
            ->deleteWhatsAppMedia($resource);
    }

    private function getResource(): WhatsAppDeleteMediaResource
    {
        return new WhatsAppDeleteMediaResource(
            'sender',
            'url'
        );
    }
}
