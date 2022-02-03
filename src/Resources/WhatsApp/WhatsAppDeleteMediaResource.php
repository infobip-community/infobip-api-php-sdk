<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\ResourcePayloadInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/delete-whatsapp-media
 */
final class WhatsAppDeleteMediaResource implements ResourcePayloadInterface
{
    /** @var string */
    private $sender;

    /** @var string */
    private $url;

    public function __construct(
        string $sender,
        string $url
    ) {
        $this->sender = $sender;
        $this->url = $url;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function payload(): array
    {
        return [
            'url' => $this->url
        ];
    }
}
