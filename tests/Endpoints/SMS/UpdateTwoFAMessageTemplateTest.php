<?php

declare(strict_types=1);

namespace Tests\Endpoints\SMS;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\SMS\UpdateTwoFAMessageTemplateResource;
use Tests\Endpoints\TestCase;

final class UpdateTwoFAMessageTemplateTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/SMS/update_two_fa_message_template_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->updateTwoFAMessageTemplate($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsServerErrorException(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/SMS/general_sms_error.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SERVER_ERROR,
            $mockedResponse
        );

        // act & assert
        $this->expectException(InfobipServerException::class);
        $this->expectExceptionCode(StatusCode::SERVER_ERROR);
        $this->expectExceptionMessage($mockedResponse['requestError']['serviceException']['text']);

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->updateTwoFAMessageTemplate($resource);

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
                ->SMS()
                ->updateTwoFAMessageTemplate($resource);
        } catch (InfobipValidationException $exception) {
            $this->assertArrayHasKey('speechRate', $exception->getValidationErrors());

            throw $exception;
        }
    }

    private function getResource(): UpdateTwoFAMessageTemplateResource
    {
        return new UpdateTwoFAMessageTemplateResource('appId', 'name');
    }

    private function getInvalidResource(): UpdateTwoFAMessageTemplateResource
    {
        return (new UpdateTwoFAMessageTemplateResource('bulkId', 'messageText'))
            ->setSpeechRate(30.5);
    }
}
