<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;
use Infobip\Validations\Rules\UrlRule;

final class TemplateMessage implements ModelInterface, ModelValidationInterface
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    /** @var TemplateContent */
    private $content;

    /** @var string|null */
    private $messageId = null;

    /** @var string|null */
    private $callbackData = null;

    /** @var string|null */
    private $notifyUrl = null;

    /** @var SmsFailover|null */
    private $smsFailover = null;

    public function __construct(
        string $from,
        string $to,
        TemplateContent $content
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

    public function setSmsFailover(?SmsFailover $smsFailover): self
    {
        $this->smsFailover = $smsFailover;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'from' => $this->from,
            'to' => $this->to,
            'messageId' => $this->messageId,
            'content' => $this->content->toArray(),
            'callbackData' => $this->callbackData,
            'notifyUrl' => $this->notifyUrl,
            'smsFailover' => $this->smsFailover ? $this->smsFailover->toArray() : null,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('from', $this->from, 1, 24))
            ->addRule(new BetweenLengthRule('to', $this->to, 1, 24))
            ->addRule(new BetweenLengthRule('messageId', $this->messageId, 1, 50))
            ->addRule(new UrlRule('notifyUrl', $this->notifyUrl))
            ->addRule(new BetweenLengthRule('callbackData', $this->callbackData, 0, 4000))
            ->addModelRules($this->content)
            ->addModelRules($this->smsFailover);
    }
}
