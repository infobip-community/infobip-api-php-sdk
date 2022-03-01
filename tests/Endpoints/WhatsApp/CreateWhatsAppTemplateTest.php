<?php

declare(strict_types=1);

namespace Tests\Endpoints\WhatsApp;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipBadRequestException;
use Infobip\Exceptions\InfobipTooManyRequestException;
use Infobip\Resources\WhatsApp\Enums\CreateTemplateCategoryType;
use Infobip\Resources\WhatsApp\Models\Structure;
use Infobip\Resources\WhatsApp\WhatsAppCreateTemplateResource;
use Tests\Endpoints\TestCase;

final class CreateWhatsAppTemplateTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/create_whatsapp_template_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->whatsApp()
            ->createWhatsAppTemplate($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/create_whatsapp_template_bad_request.json');

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
            ->createWhatsAppTemplate($resource);
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

        $this
            ->getInfobipClient()
            ->whatsApp()
            ->createWhatsAppTemplate($resource);
    }

    private function getResource(): WhatsAppCreateTemplateResource
    {
        return new WhatsAppCreateTemplateResource(
            'sender',
            'name',
            'en_GB',
            new CreateTemplateCategoryType(CreateTemplateCategoryType::ACCOUNT_UPDATE),
            new Structure('body')
        );
    }
}
