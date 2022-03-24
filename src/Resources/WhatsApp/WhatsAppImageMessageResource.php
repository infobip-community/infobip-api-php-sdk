<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\WhatsApp\Models\ImageContent;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-image-message
 */
final class WhatsAppImageMessageResource implements ResourcePayloadInterface
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    /** @var ImageContent */
    private $content;

    /** @var string|null */
    private $messageId = null;

    /** @var string|null */
    private $bulkId = null;

    /** @var string|null */
    private $callbackData = null;

    /** @var string|null */
    private $notifyUrl = null;

    public function __construct(
        string $from,
        string $to,
        ImageContent $content
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

    public function setBulkId(?string $bulkId): self
    {
        $this->bulkId = $bulkId;
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
            'bulkId' => $this->bulkId,
            'content' => $this->content->toArray(),
            'callbackData' => $this->callbackData,
            'notifyUrl' => $this->notifyUrl,
        ]);
    }
}
