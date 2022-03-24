<?php

declare(strict_types=1);

namespace Tests\Endpoints\SMS;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Resources\SMS\Enums\StatusType;
use Infobip\Resources\SMS\SendTwoFAPinCodeOverSMSResource;
use Infobip\Resources\SMS\UpdateScheduledSMSMessagesStatusResource;
use Tests\Endpoints\TestCase;

final class SendTwoFAPinCodeOverSMSTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/SMS/send_two_fa_pin_code_over_sms_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->sendTwoFAPinCodeOverSMS($resource);

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
            ->sendTwoFAPinCodeOverSMS($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): SendTwoFAPinCodeOverSMSResource
    {
        return new SendTwoFAPinCodeOverSMSResource(
            'applicationId',
            'messageId',
            'to'
        );
    }
}
