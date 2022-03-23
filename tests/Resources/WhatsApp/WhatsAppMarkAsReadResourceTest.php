<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\WhatsAppMarkAsReadResource;
use Tests\TestCase;

final class WhatsAppMarkAsReadResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $sender = 'sender';
        $messageId = 'messageId';

        // act
        $whatsAppMarkAsReadResource = new WhatsAppMarkAsReadResource(
            $sender,
            $messageId
        );

        // assert
        $this->assertSame($sender, $whatsAppMarkAsReadResource->getSender());
        $this->assertSame($messageId, $whatsAppMarkAsReadResource->getMessageId());
    }
}
