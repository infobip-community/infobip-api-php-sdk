<?php

declare(strict_types=1);

namespace Tests\Endpoints\WhatsApp;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipForbiddenException;
use Infobip\Exceptions\InfobipNotFoundException;
use Infobip\Resources\WhatsApp\WhatsAppDownloadInboundMediaResource;
use Tests\Endpoints\TestCase;

final class DownloadWhatsAppInboundMediaTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/download_whatsapp_inbound_media_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->whatsApp()
            ->downloadWhatsAppInboundMedia($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsSenderNotFoundException(): void
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
            ->downloadWhatsAppInboundMedia($resource);
    }

    public function testApiCallExpectsMediaNotFoundException(): void
    {
        // arrange
        $resource = $this->getResource();

        $this->setMockedGuzzleHttpClient(
            StatusCode::NOT_FOUND,
            []
        );

        // act & assert
        $this->expectException(InfobipNotFoundException::class);
        $this->expectExceptionCode(StatusCode::NOT_FOUND);

        $this
            ->getInfobipClient()
            ->whatsApp()
            ->downloadWhatsAppInboundMedia($resource);
    }

    private function getResource(): WhatsAppDownloadInboundMediaResource
    {
        return new WhatsAppDownloadInboundMediaResource(
            'mediaId',
            'sender'
        );
    }
}
