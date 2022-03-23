<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\WhatsAppDeleteMediaResource;
use Tests\TestCase;

final class WhatsAppDeleteMediaResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $sender = 'sender';
        $url = 'url';

        $expectedPayload = [
            'url' => $url,
        ];

        // act
        $whatsAppDeleteMediaResource = new WhatsAppDeleteMediaResource(
            $sender,
            $url
        );

        // assert
        $this->assertSame($sender, $whatsAppDeleteMediaResource->getSender());
        $this->assertSame($expectedPayload, $whatsAppDeleteMediaResource->payload());
    }
}
