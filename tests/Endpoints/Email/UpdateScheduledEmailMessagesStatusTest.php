<?php

declare(strict_types=1);

namespace Tests\Endpoints\Email;

use Infobip\Enums\StatusCode;
use Infobip\Resources\Email\Enums\Status;
use Infobip\Resources\Email\UpdateScheduledEmailMessagesStatusResource;
use Tests\Endpoints\TestCase;

final class UpdateScheduledEmailMessagesStatusTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/Email/update_scheduled_email_messages_status_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->email()
            ->updateScheduledEmailMessagesStatus($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    private function getResource(): UpdateScheduledEmailMessagesStatusResource
    {
        return new UpdateScheduledEmailMessagesStatusResource(
            'bulkId',
            new Status(Status::PENDING)
        );
    }
}
