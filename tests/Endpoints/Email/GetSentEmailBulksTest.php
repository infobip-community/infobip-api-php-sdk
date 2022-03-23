<?php

declare(strict_types=1);

namespace Tests\Endpoints\Email;

use Infobip\Enums\StatusCode;
use Infobip\Resources\Email\SentEmailBulksResource;
use Tests\Endpoints\TestCase;

final class GetSentEmailBulksTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/Email/get_sent_email_bulks_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->email()
            ->getSentEmailBulks($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): SentEmailBulksResource
    {
        return new SentEmailBulksResource('bulkId');
    }
}
