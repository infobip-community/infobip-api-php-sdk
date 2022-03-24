<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\SMS\Enums\LanguageCodeType;
use Infobip\Resources\SMS\Enums\TransliterationType;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/preview-sms-message
 */
final class PreviewSMSMessageResource implements ResourcePayloadInterface
{
    /** @var string */
    private $text;

    /** @var LanguageCodeType|null */
    private $languageCode;

    /** @var TransliterationType|null */
    private $transliteration;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function setLanguageCode(?LanguageCodeType $languageCode): self
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    public function setTransliteration(?TransliterationType $transliteration): self
    {
        $this->transliteration = $transliteration;

        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'languageCode' => $this->languageCode ? $this->languageCode->getValue() : null,
            'text' => $this->text,
            'transliteration' => $this->transliteration ? $this->transliteration->getValue() : null
        ]);
    }
}
