<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourceQueryOptionsInterface;
use Infobip\Resources\SMS\Enums\NotifyContentType;
use Infobip\Resources\SMS\Enums\TransliterationType;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/send-sms-message-over-query-parameters
 */
final class SendSMSMessageOverQueryParametersResource implements ResourceQueryOptionsInterface
{
    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var string[] */
    private $to;

    /** @var string|null */
    private $bulkId;

    /** @var string|null */
    private $from;

    /** @var string|null */
    private $text;

    /** @var bool|null */
    private $flash;

    /** @var TransliterationType|null */
    private $transliteration;

    /** @var string|null */
    private $languageCode;

    /** @var bool|null */
    private $intermediateReport;

    /** @var string|null */
    private $notifyUrl;

    /** @var string|null */
    private $callbackData;

    /** @var NotifyContentType|null */
    private $notifyContentType;

    /** @var int|null */
    private $validityPeriod;

    /** @var string|null */
    private $sendAt;

    /** @var string|null */
    private $track;

    /** @var string|null */
    private $processKey;

    /** @var string|null */
    private $trackingType;

    /** @var string|null */
    private $indiaDltContentTemplateId;

    /** @var string|null */
    private $indiaDltPrincipalEntityId;

    public function __construct(
        string $username,
        string $password,
        array $to
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->to = $to;
    }

    public function setBulkId(?string $bulkId): self
    {
        $this->bulkId = $bulkId;

        return $this;
    }

    public function setFrom(?string $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function setFlash(?bool $flash): self
    {
        $this->flash = $flash;

        return $this;
    }

    public function setTransliteration(?TransliterationType $transliteration): self
    {
        $this->transliteration = $transliteration;

        return $this;
    }

    public function setLanguageCode(?string $languageCode): self
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    public function setIntermediateReport(?bool $intermediateReport): self
    {
        $this->intermediateReport = $intermediateReport;

        return $this;
    }

    public function setNotifyUrl(?string $notifyUrl): self
    {
        $this->notifyUrl = $notifyUrl;

        return $this;
    }

    public function setNotifyContentType(?NotifyContentType $notifyContentType): self
    {
        $this->notifyContentType = $notifyContentType;

        return $this;
    }

    public function setCallbackData(?string $callbackData): self
    {
        $this->callbackData = $callbackData;

        return $this;
    }

    public function setValidityPeriod(?int $validityPeriod): self
    {
        $this->validityPeriod = $validityPeriod;

        return $this;
    }

    public function setSendAt(?string $sendAt): self
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function setTrack(?string $track): self
    {
        $this->track = $track;

        return $this;
    }

    public function setProcessKey(?string $processKey): self
    {
        $this->processKey = $processKey;

        return $this;
    }

    public function setTrackingType(?string $trackingType): self
    {
        $this->trackingType = $trackingType;

        return $this;
    }

    public function setIndiaDltContentTemplateId(?string $indiaDltContentTemplateId): self
    {
        $this->indiaDltContentTemplateId = $indiaDltContentTemplateId;

        return $this;
    }

    public function setIndiaDltPrincipalEntityId(?string $indiaDltPrincipalEntityId): self
    {
        $this->indiaDltPrincipalEntityId = $indiaDltPrincipalEntityId;

        return $this;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'username' => $this->username,
            'password' => $this->password,
            'bulkId' => $this->bulkId,
            'from' => $this->from,
            'to' => $this->to,
            'text' => $this->text,
            'flash' => $this->flash,
            'transliteration' => $this->transliteration ? $this->transliteration->getValue() : null,
            'languageCode' => $this->languageCode,
            'intermediateReport' => $this->intermediateReport,
            'notifyUrl' => $this->notifyUrl,
            'notifyContentType' => $this->notifyContentType ? $this->notifyContentType->getValue() : null,
            'callbackData' => $this->callbackData,
            'validityPeriod' => $this->validityPeriod,
            'sendAt' => $this->sendAt,
            'track' => $this->track,
            'processKey' => $this->processKey,
            'trackingType' => $this->trackingType,
            'indiaDltContentTemplateId' => $this->indiaDltContentTemplateId,
            'indiaDltPrincipalEntityId' => $this->indiaDltPrincipalEntityId,
        ]);
    }
}
