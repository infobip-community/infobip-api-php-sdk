<?php

declare(strict_types=1);

namespace Tests\Endpoints\Email;

use Infobip\Enums\StatusCode;
use Infobip\Resources\Email\EmailLogsResource;
use Tests\Endpoints\TestCase;

final class GetEmailLogsTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/Email/get_email_logs_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->email()
            ->getEmailLogs($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): EmailLogsResource
    {
        return new EmailLogsResource();
    }
}
