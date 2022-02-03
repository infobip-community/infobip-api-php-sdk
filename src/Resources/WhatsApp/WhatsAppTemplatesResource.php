<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/get-whatsapp-templates
 */
final class WhatsAppTemplatesResource
{
    /** @var string */
    private $sender;

    public function __construct(string $sender)
    {
        $this->sender = $sender;
    }

    public function getSender(): string
    {
        return $this->sender;
    }
}
