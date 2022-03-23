<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\WhatsAppTemplatesResource;
use Tests\TestCase;

final class WhatsAppTemplatesResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $sender = 'sender';

        // act
        $whatsAppTemplatesResource = new WhatsAppTemplatesResource(
            $sender
        );

        // assert
        $this->assertSame($sender, $whatsAppTemplatesResource->getSender());
    }
}
