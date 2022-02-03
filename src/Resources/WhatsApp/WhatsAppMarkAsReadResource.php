<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/mark-whatsapp-message-as-read
 */
final class WhatsAppMarkAsReadResource
{
    /** @var string */
    private $sender;

    /** @var string */
    private $messageId;

    public function __construct(
        string $sender,
        string $messageId
    ) {
        $this->sender = $sender;
        $this->messageId = $messageId;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }
}
