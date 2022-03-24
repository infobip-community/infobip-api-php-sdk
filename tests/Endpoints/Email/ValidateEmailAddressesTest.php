<?php

declare(strict_types=1);

namespace Tests\Endpoints\Email;

use Infobip\Enums\StatusCode;
use Infobip\Exceptions\InfobipBadRequestException;
use Infobip\Resources\Email\EmailDeliveryReportsResource;
use Infobip\Resources\Email\FullyFeaturedEmailResource;
use Infobip\Resources\Email\ValidateEmailAddressesResource;
use Tests\Endpoints\TestCase;

final class ValidateEmailAddressesTest extends TestCase
{
    public function testApiCallExpectsSuccess(): void
    {
        // arrange
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/Email/validate_email_addresses_success.json');

        $this->setMockedGuzzleHttpClient(
            StatusCode::SUCCESS,
            $mockedResponse
        );

        // act
        $response = $this
            ->getInfobipClient()
            ->email()
            ->validateEmailAddresses($resource);

        // assert
        $this->assertSame($mockedResponse, $response);
    }

    public function testApiCallExpectsBadRequestException(): void
    {
        $resource = $this->getResource();
        $mockedResponse = $this->loadJsonDataFixture('Endpoints/Email/validate_email_addresses_bad_request.json');

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
            ->validateEmailAddresses($resource);
    }

    private function getResource(): ValidateEmailAddressesResource
    {
        return new ValidateEmailAddressesResource("validate@email.com");
    }
}
