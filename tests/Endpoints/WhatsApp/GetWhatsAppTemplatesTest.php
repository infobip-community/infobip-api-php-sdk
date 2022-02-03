<?php

declare(strict_types=1);

namespace Tests\Endpoints\WhatsApp;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipBadRequestException;
use Infobip\Exceptions\InfobipForbiddenException;
use Infobip\Exceptions\InfobipNotFoundException;
use Infobip\Resources\WhatsApp\WhatsAppGetMediaMetaDataResource;
use Infobip\Resources\WhatsApp\WhatsAppTemplatesResource;
use Tests\Endpoints\TestCase;

final class GetWhatsAppTemplatesTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/get_whatsapp_templates_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->whatsApp()
            ->getWhatsAppTemplates($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/get_whatsapp_templates_bad_request.json');

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
            ->getWhatsAppTemplates($resource);
    }

    public function testApiCallExpectsForbiddenException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/get_whatsapp_templates_forbidden.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::FORBIDDEN,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipForbiddenException::class);
        $this->expectExceptionCode(StatusCode::FORBIDDEN);

        $this
            ->getInfobipClient()
            ->whatsApp()
            ->getWhatsAppTemplates($resource);
    }

    private function getResource(): WhatsAppTemplatesResource
    {
        return new WhatsAppTemplatesResource(
            'sender'
        );
    }
}
