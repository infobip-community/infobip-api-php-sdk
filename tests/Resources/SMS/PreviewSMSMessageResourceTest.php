<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Enums\LanguageCodeType;
use Infobip\Resources\SMS\Enums\TransliterationType;
use Infobip\Resources\SMS\PreviewSMSMessageResource;
use Tests\TestCase;

final class PreviewSMSMessageResourceTest extends TestCase
{
    public function testCanResourceWithAllData(): void
    {
        // arrange
        $text = 'text';
        $languageCode = new LanguageCodeType(LanguageCodeType::ES);
        $transliteration = new TransliterationType(TransliterationType::CENTRAL_EUROPEAN);

        $expectedArray = [
            'languageCode' => $languageCode->getValue(),
            'text' => $text,
            'transliteration' => $transliteration->getValue()
        ];

        // act
        $previewSMSMessageResource = (new PreviewSMSMessageResource($text))
            ->setLanguageCode($languageCode)
            ->setTransliteration($transliteration);

        // assert
        $this->assertSame($expectedArray, $previewSMSMessageResource->payload());
    }

    public function testCanResourceWithPartialData(): void
    {
        // arrange
        $text = 'text';
        $languageCode = new LanguageCodeType(LanguageCodeType::ES);

        $expectedArray = [
            'languageCode' => $languageCode->getValue(),
            'text' => $text
        ];

        // act
        $previewSMSMessageResource = (new PreviewSMSMessageResource($text))
            ->setLanguageCode($languageCode);

        // assert
        $this->assertSame($expectedArray, $previewSMSMessageResource->payload());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $text = 'text';

        $expectedArray = [
            'text' => $text
        ];

        // act
        $previewSMSMessageResource = new PreviewSMSMessageResource($text);

        // assert
        $this->assertSame($expectedArray, $previewSMSMessageResource->payload());
    }
}
