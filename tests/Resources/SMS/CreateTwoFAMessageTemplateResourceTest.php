<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\CreateTwoFAMessageTemplateResource;
use Infobip\Resources\SMS\Enums\LanguageType;
use Infobip\Resources\SMS\Enums\PinType;
use Infobip\Resources\SMS\Models\Regional;
use Tests\TestCase;

final class CreateTwoFAMessageTemplateResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $appId = 'appId';
        $language = new LanguageType(LanguageType::EN);
        $messageText = 'messageText';
        $pinLength = 50;
        $pinType = new PinType(PinType::ALPHA);
        $regional = (new Regional('principalEntityId'))->setContentTemplateId('contentTemplateId');
        $repeatDTMF = 'repeatDTMF';
        $senderId = 'senderId';
        $speechRate = 0.5;

        $expectedArray = [
            'language' => $language->getValue(),
            'messageText' => $messageText,
            'pinLength' => $pinLength,
            'pinType' => $pinType->getValue(),
            'regional' => $regional,
            'repeatDTMF' => $repeatDTMF,
            'senderId' => $senderId,
            'speechRate' => $speechRate
        ];

        // act
        $createTwoFAMessageTemplateResource = (new CreateTwoFAMessageTemplateResource(
            $appId,
            $messageText,
            $pinType
        ))
            ->setLanguage($language)
            ->setPinLength($pinLength)
            ->setRegional($regional)
            ->setRepeatDTMF($repeatDTMF)
            ->setSenderId($senderId)
            ->setSpeechRate($speechRate);

        // assert
        $this->assertSame($expectedArray, $createTwoFAMessageTemplateResource->payload());
        $this->assertSame($appId, $createTwoFAMessageTemplateResource->getAppId());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $appId = 'appId';
        $language = new LanguageType(LanguageType::EN);
        $messageText = 'messageText';
        $pinLength = 50;
        $pinType = new PinType(PinType::ALPHA);

        $expectedArray = [
            'language' => $language->getValue(),
            'messageText' => $messageText,
            'pinLength' => $pinLength,
            'pinType' => $pinType->getValue(),
        ];

        // act
        $createTwoFAMessageTemplateResource = (new CreateTwoFAMessageTemplateResource(
            $appId,
            $messageText,
            $pinType
        ))
            ->setLanguage($language)
            ->setPinLength($pinLength);

        // assert
        $this->assertSame($expectedArray, $createTwoFAMessageTemplateResource->payload());
        $this->assertSame($appId, $createTwoFAMessageTemplateResource->getAppId());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $appId = 'appId';
        $messageText = 'messageText';
        $pinType = new PinType(PinType::ALPHA);

        $expectedArray = [
            'messageText' => $messageText,
            'pinType' => $pinType->getValue(),
        ];

        // act
        $createTwoFAMessageTemplateResource = new CreateTwoFAMessageTemplateResource(
            $appId,
            $messageText,
            $pinType
        );

        // assert
        $this->assertSame($expectedArray, $createTwoFAMessageTemplateResource->payload());
        $this->assertSame($appId, $createTwoFAMessageTemplateResource->getAppId());
    }
}
