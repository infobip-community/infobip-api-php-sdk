<?php

declare(strict_types=1);

namespace Tests\Endpoints\Email;

use Infobip\Enums\StatusCode;
use Infobip\Resources\Email\RescheduleEmailMessagesResource;
use Tests\Endpoints\TestCase;

final class RescheduleEmailMessagesTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/Email/reschedule_email_messages_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->email()
            ->rescheduleEmailMessages($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): RescheduleEmailMessagesResource
    {
        return new RescheduleEmailMessagesResource('bulkId', '22-03-22');
    }
}
