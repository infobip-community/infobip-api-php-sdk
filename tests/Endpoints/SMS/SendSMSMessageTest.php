<?php

declare(strict_types=1);

namespace Tests\Endpoints\SMS;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\SMS\Models\Message;
use Infobip\Resources\SMS\SendSMSMessageResource;
use Tests\Endpoints\TestCase;

final class SendSMSMessageTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/SMS/send_sms_message_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->sendSMSMessage($resource);

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
            ->sendSMSMessage($resource);

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
                ->sendSMSMessage($resource);
        } catch (InfobipValidationException $exception) {
            $this->assertArrayHasKey('message.callbackData', $exception->getValidationErrors());
            $this->assertArrayHasKey('message.validityPeriod', $exception->getValidationErrors());

            throw $exception;
        }
    }

    private function getResource(): SendSMSMessageResource
    {
        return new SendSMSMessageResource();
    }

    private function getInvalidResource(): SendSMSMessageResource
    {
        $message = (new Message())
            ->setCallbackData($this->faker->text(4500))
            ->setValidityPeriod(3000);

        return (new SendSMSMessageResource())
            ->addMessage($message);
    }
}
