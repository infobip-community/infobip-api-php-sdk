<?php

declare(strict_types=1);

namespace Tests\Endpoints\SMS;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipServerException;
use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\SMS\GetOutboundSMSMessageDeliveryReportsResource;
use Tests\Endpoints\TestCase;

final class GetOutboundSMSMessageDeliveryReportsTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture(
            'Endpoints/SMS/get_outbound_sms_message_delivery_reports_success.json'
        );

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->SMS()
            ->getOutboundSMSMessageDeliveryReports($resource);

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
            ->getOutboundSMSMessageDeliveryReports($resource);

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
                ->getOutboundSMSMessageDeliveryReports($resource);
        } catch (InfobipValidationException $exception) {
            $this->assertArrayHasKey('limit', $exception->getValidationErrors());

            throw $exception;
        }
    }

    private function getResource(): GetOutboundSMSMessageDeliveryReportsResource
    {
        return new GetOutboundSMSMessageDeliveryReportsResource();
    }

    private function getInvalidResource(): GetOutboundSMSMessageDeliveryReportsResource
    {
        return (new GetOutboundSMSMessageDeliveryReportsResource())
            ->setLimit(5000);
    }
}
