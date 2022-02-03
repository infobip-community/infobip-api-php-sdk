<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\WhatsApp\Models\ContactContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-contact-message
 */
final class WhatsAppContactMessageResource implements ResourcePayloadInterface
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    /** @var ContactContent */
    private $content;

    /** @var string|null */
    private $messageId = null;

    /** @var string|null */
    private $callbackData = null;

    /** @var string|null */
    private $notifyUrl = null;

    public function __construct(
        string $from,
        string $to,
        ContactContent $content
    ) {
        $this->from = $from;
        $this->to = $to;
        $this->content = $content;
    }

    public function setMessageId(?string $messageId): self
    {
        $this->messageId = $messageId;
        return $this;
    }

    public function setCallbackData(?string $callbackData): self
    {
        $this->callbackData = $callbackData;
        return $this;
    }

    public function setNotifyUrl(?string $notifyUrl): self
    {
        $this->notifyUrl = $notifyUrl;
        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'from' => $this->from,
            'to' => $this->to,
            'messageId' => $this->messageId,
            'content' => $this->content->toArray(),
            'callbackData' => $this->callbackData,
            'notifyUrl' => $this->notifyUrl,
        ]);
    }
}
