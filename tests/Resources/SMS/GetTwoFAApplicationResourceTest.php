<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\GetTwoFAApplicationResource;
use Tests\TestCase;

final class GetTwoFAApplicationResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // act
        $getTwoFAApplicationResource = new GetTwoFAApplicationResource('appId');

        // assert
        $this->assertSame('appId', $getTwoFAApplicationResource->getAppId());
    }
}
