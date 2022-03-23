<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\GetTwoFAMessageTemplatesResource;
use Tests\TestCase;

final class GetTwoFAMessageTemplatesResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // act
        $getTwoFAMessageTemplatesResource = new GetTwoFAMessageTemplatesResource('appId');

        // assert
        $this->assertSame('appId', $getTwoFAMessageTemplatesResource->getAppId());
    }
}
