<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\GetTwoFAVerificationStatusResource;
use Tests\TestCase;

final class GetTwoFAVerificationStatusResourceTest extends TestCase
{
    public function testCanResourceWithAllData(): void
    {
        // arrange
        $appId = 'appId';
        $msisdn = 'msisdn';
        $verified = true;
        $sent = false;

        $expectedArray = [
            'msisdn' => $msisdn,
            'verified' => $verified,
            'sent' => $sent
        ];

        // act
        $getTwoFAVerificationStatusResource = (new GetTwoFAVerificationStatusResource(
            $appId,
            $msisdn
        ))
            ->setVerified($verified)
            ->setSent($sent);

        // assert
        $this->assertSame($expectedArray, $getTwoFAVerificationStatusResource->queryOptions());
        $this->assertSame($appId, $getTwoFAVerificationStatusResource->getAppId());
    }

    public function testCanResourceWithPartialData(): void
    {
        // arrange
        $appId = 'appId';
        $msisdn = 'msisdn';
        $verified = true;

        $expectedArray = [
            'msisdn' => $msisdn,
            'verified' => $verified,
        ];

        // act
        $getTwoFAVerificationStatusResource = (new GetTwoFAVerificationStatusResource(
            $appId,
            $msisdn
        ))
            ->setVerified($verified);

        // assert
        $this->assertSame($expectedArray, $getTwoFAVerificationStatusResource->queryOptions());
        $this->assertSame($appId, $getTwoFAVerificationStatusResource->getAppId());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $appId = 'appId';
        $msisdn = 'msisdn';

        $expectedArray = [
            'msisdn' => $msisdn
        ];

        // act
        $getTwoFAVerificationStatusResource = new GetTwoFAVerificationStatusResource(
            $appId,
            $msisdn
        );

        // assert
        $this->assertSame($expectedArray, $getTwoFAVerificationStatusResource->queryOptions());
        $this->assertSame($appId, $getTwoFAVerificationStatusResource->getAppId());
    }
}
