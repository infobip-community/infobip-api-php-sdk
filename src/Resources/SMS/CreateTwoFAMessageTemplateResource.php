<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceValidationInterface;
use Infobip\Resources\SMS\Enums\LanguageType;
use Infobip\Resources\SMS\Enums\PinType;
use Infobip\Resources\SMS\Models\Regional;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenNumberRule;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/create-2fa-message-template
 */
final class CreateTwoFAMessageTemplateResource implements ResourcePayloadInterface, ResourceValidationInterface
{
    /** @var string */
    private $appId;

    /** @var string */
    private $messageText;

    /** @var PinType */
    private $pinType;

    /** @var LanguageType|null */
    private $language;

    /** @var int|null */
    private $pinLength;

    /** @var Regional|null */
    private $regional;

    /** @var string|null */
    private $repeatDTMF;

    /** @var string|null */
    private $senderId;

    /** @var float|null */
    private $speechRate;

    public function __construct(
        string $appId,
        string $messageText,
        PinType $pinType
    ) {
        $this->appId = $appId;
        $this->messageText = $messageText;
        $this->pinType = $pinType;
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    public function setLanguage(?LanguageType $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function setPinLength(?int $pinLength): self
    {
        $this->pinLength = $pinLength;

        return $this;
    }

    public function setRegional(?Regional $regional): self
    {
        $this->regional = $regional;

        return $this;
    }

    public function setRepeatDTMF(?string $repeatDTMF): self
    {
        $this->repeatDTMF = $repeatDTMF;

        return $this;
    }

    public function setSenderId(?string $senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function setSpeechRate(?float $speechRate): self
    {
        $this->speechRate = $speechRate;

        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'language' => $this->language ? $this->language->getValue() : null,
            'messageText' => $this->messageText,
            'pinLength' => $this->pinLength,
            'pinType' => $this->pinType->getValue(),
            'regional' => $this->regional,
            'repeatDTMF' => $this->repeatDTMF,
            'senderId' => $this->senderId,
            'speechRate' => $this->speechRate
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenNumberRule('speechRate', $this->speechRate, 0.5, 2));
    }
}
