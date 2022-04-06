<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Resources\WhatsApp\Models\InteractiveButtonsContent;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;
use Infobip\Validations\Rules\UrlRule;

/**
 * @link https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-interactive-buttons-message
 */
final class WhatsAppInteractiveButtonsMessageResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    /** @var InteractiveButtonsContent */
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
        InteractiveButtonsContent $content
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

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('from', $this->from, 1, 24))
            ->addRule(new BetweenLengthRule('to', $this->to, 1, 24))
            ->addRule(new BetweenLengthRule('messageId', $this->messageId, 0, 50))
            ->addRule(new BetweenLengthRule('callbackData', $this->callbackData, 0, 4000))
            ->addRule(new BetweenLengthRule('notifyUrl', $this->notifyUrl, 0, 2048))
            ->addRule(new UrlRule('notifyUrl', $this->notifyUrl))
            ->addModelRules($this->content);
    }
}
