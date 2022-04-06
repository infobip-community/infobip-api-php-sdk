<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS;

use Infobip\Resources\RCS\Models\SMSFailover;
use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\RCS\Contracts\MessageContentInterface;
use Infobip\Resources\RCS\Enums\ValidityPeriodTimeUnit;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\UrlRule;

/**
 * @link https://www.infobip.com/docs/api#channels/rcs/send-rcs-message
 */
final class RCSMessageResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /** @var string */
    private $to;

    /** @var MessageContentInterface */
    private $content;

    /** @var string|null */
    private $from = null;

    /** @var int|null */
    private $validityPeriod = null;

    /** @var ValidityPeriodTimeUnit|null */
    private $validityPeriodTimeUnit = null;

    /** @var SMSFailover|null */
    private $smsFailover = null;

    /** @var string|null */
    private $notifyUrl = null;

    /** @var string|null */
    private $callbackData = null;

    /** @var string|null */
    private $messageId = null;

    public function __construct(
        string $to,
        MessageContentInterface $content
    ) {
        $this->to = $to;
        $this->content = $content;
    }

    public function setFrom(?string $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function setValidityPeriod(?int $validityPeriod): self
    {
        $this->validityPeriod = $validityPeriod;

        return $this;
    }

    public function setValidityPeriodTimeUnit(?ValidityPeriodTimeUnit $validityPeriodTimeUnit): self
    {
        $this->validityPeriodTimeUnit = $validityPeriodTimeUnit;

        return $this;
    }

    public function setSmsFailover(?SMSFailover $smsFailover): self
    {
        $this->smsFailover = $smsFailover;

        return $this;
    }

    public function setNotifyUrl(?string $notifyUrl): self
    {
        $this->notifyUrl = $notifyUrl;

        return $this;
    }

    public function setCallbackData(?string $callbackData): self
    {
        $this->callbackData = $callbackData;

        return $this;
    }

    public function setMessageId(?string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'from' => $this->from,
            'to' => $this->to,
            'validityPeriod' => $this->validityPeriod,
            'validityPeriodTimeUnit' => $this->validityPeriodTimeUnit ? $this->validityPeriodTimeUnit->getValue() : null,
            'content' => $this->content->toArray(),
            'smsFailover' => $this->smsFailover ? $this->smsFailover->toArray() : null,
            'notifyUrl' => $this->notifyUrl,
            'callbackData' => $this->callbackData,
            'messageId' => $this->messageId,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new UrlRule('notifyUrl', $this->notifyUrl))
            ->addModelRules($this->content);
    }
}
