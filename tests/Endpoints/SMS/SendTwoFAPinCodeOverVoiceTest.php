<?php

declare(strict_types=1);

namespace Tests\Endpoints\SMS;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Resources\SMS\SendTwoFAPinCodeOverSMSResource;
use Infobip\Resources\SMS\SendTwoFAPinCodeOverVoiceResource;
use Tests\Endpoints\TestCase;

final class SendTwoFAPinCodeOverVoiceTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/SMS/send_two_fa_pin_code_over_voice_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->sendTwoFAPinCodeOverVoice($resource);

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
            ->sendTwoFAPinCodeOverVoice($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): SendTwoFAPinCodeOverVoiceResource
    {
        return new SendTwoFAPinCodeOverVoiceResource(
            'applicationId',
            'messageId',
            'to'
        );
    }
}
