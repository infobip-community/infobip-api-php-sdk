<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\WhatsAppDownloadInboundMediaResource;
use Tests\TestCase;

final class WhatsAppDownloadInboundMediaResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $sender = 'sender';
        $mediaId = 'mediaId';

        // act
        $whatsAppDocumentMessageResource = new WhatsAppDownloadInboundMediaResource(
            $sender,
            $mediaId
        );

        // assert
        $this->assertSame($sender, $whatsAppDocumentMessageResource->getSender());
        $this->assertSame($mediaId, $whatsAppDocumentMessageResource->getMediaId());
    }
}
