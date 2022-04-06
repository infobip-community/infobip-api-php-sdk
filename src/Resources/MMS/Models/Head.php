<?php

declare(strict_types=1);

namespace Infobip\Resources\MMS\Models;

use DateTimeImmutable;
use DateTimeInterface;
use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\Shared\Models\DeliveryTimeWindow;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\MaxLengthRule;
use Infobip\Validations\Rules\UrlRule;

final class Head implements ModelInterface, ModelValidationInterface
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    /** @var string|null */
    private $id = null;

    /** @var string|null */
    private $subject = null;

    /** @var int|null */
    private $validityPeriodMinutes = null;

    /** @var string|null */
    private $callbackData = null;

    /** @var string|null */
    private $notifyUrl = null;

    /** @var DateTimeImmutable|null */
    private $sendAt = null;

    /** @var bool */
    private $intermediateReport = false;

    /** @var DeliveryTimeWindow|null */
    private $deliveryTimeWindow = null;

    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function setValidityPeriodMinutes(?int $validityPeriodMinutes): self
    {
        $this->validityPeriodMinutes = $validityPeriodMinutes;

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

    public function setSendAt(?DateTimeImmutable $sendAt): self
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function setIntermediateReport(bool $intermediateReport): self
    {
        $this->intermediateReport = $intermediateReport;

        return $this;
    }

    public function setDeliveryTimeWindow(DeliveryTimeWindow $deliveryTimeWindow): self
    {
        $this->deliveryTimeWindow = $deliveryTimeWindow;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'from' => $this->from,
            'to' => $this->to,
            'id' => $this->id,
            'subject' => $this->subject,
            'validityPeriodMinutes' => $this->validityPeriodMinutes,
            'callbackData' => $this->callbackData,
            'notifyUrl' => $this->notifyUrl,
            'sendAt' => $this->sendAt ? $this->sendAt->format(DateTimeInterface::RFC3339_EXTENDED) : null,
            'intermediateReport' => $this->intermediateReport,
            'deliveryTimeWindow' => $this->deliveryTimeWindow ? $this->deliveryTimeWindow->toArray() : null,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new MaxLengthRule('head.callbackData', $this->callbackData, 200))
            ->addRule(new UrlRule('head.notifyUrl', $this->notifyUrl))
            ->addModelRules($this->deliveryTimeWindow);
    }
}
