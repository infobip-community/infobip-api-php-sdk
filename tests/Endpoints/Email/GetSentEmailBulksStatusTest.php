<?php

declare(strict_types=1);

namespace Tests\Endpoints\Email;

use Infobip\Enums\StatusCode;
use Infobip\Resources\Email\SentEmailBulksStatusResource;
use Tests\Endpoints\TestCase;

final class GetSentEmailBulksStatusTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/Email/get_sent_email_bulks_status_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->email()
            ->getSentEmailBulksStatus($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): SentEmailBulksStatusResource
    {
        return new SentEmailBulksStatusResource('bulkId');
    }
}
