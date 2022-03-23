<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\GetTwoFAMessageTemplateResource;
use Tests\TestCase;

final class GetTwoFAMessageTemplateResourceTest extends TestCase
{
    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $appId = 'appId';
        $msgId = 'msgId';

        // act
        $getTwoFAMessageTemplateResource = new GetTwoFAMessageTemplateResource($appId, $msgId);

        // assert
        $this->assertSame($appId, $getTwoFAMessageTemplateResource->getAppId());
        $this->assertSame($msgId, $getTwoFAMessageTemplateResource->getMsgId());
    }
}
