<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\SMS\Collections\DestinationCollection;
use Infobip\Resources\Shared\Models\DeliveryTimeWindow;
use Infobip\Resources\SMS\Enums\NotifyContentType;
use Infobip\Resources\SMS\Enums\TransliterationType;

final class Message implements ModelInterface
{
    /** @var DestinationCollection */
    private $destinations;

    /** @var Binary|null */
    private $binary;

    /** @var string|null */
    private $callbackData;

    /** @var DeliveryTimeWindow|null */
    private $deliveryTimeWindow;

    /** @var bool|null */
    private $flash;

    /** @var string|null */
    private $from;

    /** @var bool|null */
    private $intermediateReport;

    /** @var Language|null */
    private $language;

    /** @var NotifyContentType|null */
    private $notifyContentType;

    /** @var string|null */
    private $notifyUrl;

    /** @var Regional|null */
    private $regional;

    /** @var string|null */
    private $sendAt;

    /** @var TransliterationType|null */
    private $transliteration;

    /** @var int|null */
    private $validityPeriod;

    public function __construct()
    {
        $this->destinations = new DestinationCollection();
    }

    public function setBinary(?Binary $binary): self
    {
        $this->binary = $binary;

        return $this;
    }

    public function setCallbackData(?string $callbackData): self
    {
        $this->callbackData = $callbackData;

        return $this;
    }

    public function setDeliveryTimeWindow(?DeliveryTimeWindow $deliveryTimeWindow): self
    {
        $this->deliveryTimeWindow = $deliveryTimeWindow;

        return $this;
    }

    public function setDestinations(DestinationCollection $destinations): self
    {
        $this->destinations = $destinations;

        return $this;
    }

    public function addDestination(Destination $destination): self
    {
        $this->destinations->add($destination);

        return $this;
    }

    public function setFlash(?bool $flash): self
    {
        $this->flash = $flash;

        return $this;
    }

    public function setFrom(?string $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function setIntermediateReport(?bool $intermediateReport): self
    {
        $this->intermediateReport = $intermediateReport;

        return $this;
    }

    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function setNotifyContentType(?NotifyContentType $notifyContentType): self
    {
        $this->notifyContentType = $notifyContentType;

        return $this;
    }

    public function setNotifyUrl(?string $notifyUrl): self
    {
        $this->notifyUrl = $notifyUrl;

        return $this;
    }

    public function setRegional(?Regional $regional): self
    {
        $this->regional = $regional;

        return $this;
    }

    public function setSendAt(?string $sendAt): self
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function setTransliteration(?TransliterationType $transliteration): self
    {
        $this->transliteration = $transliteration;

        return $this;
    }

    public function setValidityPeriod(?int $validityPeriod): self
    {
        $this->validityPeriod = $validityPeriod;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'binary' => $this->binary,
            'callbackData' => $this->callbackData,
            'deliveryTimeWindow' => $this->deliveryTimeWindow,
            'destinations' => $this->destinations->toArray(),
            'flash' => $this->flash,
            'from' => $this->from,
            'intermediateReport' => $this->intermediateReport,
            'language' => $this->language,
            'notifyContentType' => $this->notifyContentType ? $this->notifyContentType->getValue() : null,
            'notifyUrl' => $this->notifyUrl,
            'regional' => $this->regional,
            'sendAt' => $this->sendAt,
            'transliteration' => $this->transliteration ? $this->transliteration->getValue() : null,
            'validityPeriod' => $this->validityPeriod,
        ]);
    }
}
