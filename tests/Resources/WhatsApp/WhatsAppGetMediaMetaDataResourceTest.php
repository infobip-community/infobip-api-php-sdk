<?php

declare(strict_types=1);

namespace Tests\Resources\WhatsApp;

use Infobip\Resources\WhatsApp\WhatsAppGetMediaMetaDataResource;
use Tests\TestCase;

final class WhatsAppGetMediaMetaDataResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $sender = 'sender';
        $mediaId = 'mediaId';

        // act
        $whatsAppGetMediaMetaDataResource = new WhatsAppGetMediaMetaDataResource(
            $sender,
            $mediaId
        );

        // assert
        $this->assertSame($sender, $whatsAppGetMediaMetaDataResource->getSender());
        $this->assertSame($mediaId, $whatsAppGetMediaMetaDataResource->getMediaId());
    }
}
