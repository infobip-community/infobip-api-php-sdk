<?php

declare(strict_types=1);

namespace Tests\Endpoints\WhatsApp;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipBadRequestException;
use Infobip\Exceptions\InfobipTooManyRequestException;
use Infobip\Exceptions\InfobipUnauthorizedException;
use Infobip\Resources\WhatsApp\Models\TemplateBody;
use Infobip\Resources\WhatsApp\Models\TemplateContent;
use Infobip\Resources\WhatsApp\Models\TemplateData;
use Infobip\Resources\WhatsApp\Models\TemplateLanguage;
use Infobip\Resources\WhatsApp\Models\TemplateMessage;
use Infobip\Resources\WhatsApp\Models\TemplateName;
use Infobip\Resources\WhatsApp\WhatsAppTemplateMessageResource;
use Tests\Endpoints\TestCase;

final class SendWhatsAppTemplateMessageTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/send_whatsapp_template_message_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->whatsApp()
            ->sendWhatsAppTemplateMessage($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/WhatsApp/send_whatsapp_template_message_bad_request.json');

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
            ->sendWhatsAppTemplateMessage($resource);
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
            ->sendWhatsAppTemplateMessage($resource);
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
            ->sendWhatsAppTemplateMessage($resource);
    }

    private function getResource(): WhatsAppTemplateMessageResource
    {
        $from = 'from';
        $to = 'to';
        $templateName = new TemplateName('templatename');
        $language = new TemplateLanguage('language');

        $body = new TemplateBody();
        $body->addPlaceholder('placeholder');

        $data = (new TemplateData($body));

        $content = new TemplateContent($templateName, $data, $language);

        $templateMessage = (new TemplateMessage($from, $to, $content));

        return (new WhatsAppTemplateMessageResource())
            ->setBulkId('bulkId')
            ->addTemplateMessage($templateMessage);
    }
}
