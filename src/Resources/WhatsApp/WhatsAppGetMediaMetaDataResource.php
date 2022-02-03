<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/get-whatsapp-media-metadata
 */
final class WhatsAppGetMediaMetaDataResource
{
    /** @var string */
    private $sender;

    /** @var string */
    private $mediaId;

    public function __construct(
        string $sender,
        string $mediaId
    ) {
        $this->sender = $sender;
        $this->mediaId = $mediaId;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function getMediaId(): string
    {
        return $this->mediaId;
    }
}
