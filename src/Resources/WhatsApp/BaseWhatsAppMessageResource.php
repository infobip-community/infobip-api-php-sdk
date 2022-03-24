<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Resources\WhatsApp\Contracts\ContentInterface;
use Infobip\Validations\RuleCollection;
use Infobip\Validations\Rules\BetweenLengthRule;
use Infobip\Validations\Rules\UrlRule;

abstract class BaseWhatsAppMessageResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /** @var string */
    protected $from;

    /** @var string */
    protected $to;

    /** @var string|null */
    protected $messageId;

    /** @var ContentInterface */
    protected $content;

    /** @var string|null */
    protected $callbackData = null;

    /** @var string|null */
    protected $notifyUrl = null;

    public function __construct(string $from, string $to, ContentInterface $content)
    {
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

    public function validationRules(): RuleCollection
    {
        return (new RuleCollection())
            ->add(new BetweenLengthRule('from', $this->from, 1, 24))
            ->add(new BetweenLengthRule('to', $this->to, 1, 24))
            ->add(new BetweenLengthRule('messageId', $this->messageId, 0, 50))
            ->add(new BetweenLengthRule('callbackData', $this->callbackData, 0, 4000))
            ->add(new BetweenLengthRule('notifyUrl', $this->notifyUrl, 0, 2048))
            ->add(new UrlRule('notifyUrl', $this->notifyUrl))
            ->addCollection($this->content->validationRules());
    }
}
