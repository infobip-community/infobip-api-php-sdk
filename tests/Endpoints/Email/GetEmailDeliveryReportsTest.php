<?php

declare(strict_types=1);

namespace Tests\Endpoints\Email;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipBadRequestException;
use Infobip\Resources\Email\EmailDeliveryReportsResource;
use Tests\Endpoints\TestCase;

final class GetEmailDeliveryReportsTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/Email/get_email_delivery_reports_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->email()
            ->getEmailDeliveryReports($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/Email/get_email_delivery_reports_bad_request.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::BAD_REQUEST,
            $mockedResponse
        );

        $this->expectException(InfobipBadRequestException::class);
        $this->expectExceptionCode(StatusCode::BAD_REQUEST);

        // act
        $this
            ->getInfobipClient()
            ->email()
            ->getEmailDeliveryReports($resource);
    }

    private function getResource(): EmailDeliveryReportsResource
    {
        return new EmailDeliveryReportsResource();
    }
}
