<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\CreateTwoFAMessageTemplateResource;
use Infobip\Resources\SMS\Enums\LanguageType;
use Infobip\Resources\SMS\Enums\PinType;
use Infobip\Resources\SMS\Models\Regional;
use Infobip\Resources\SMS\UpdateTwoFAMessageTemplateResource;
use Tests\TestCase;

final class UpdateTwoFAMessageTemplateResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $appId = 'appId';
        $msgId = 'msgId';
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
        $updateTwoFAMessageTemplateResource = (new UpdateTwoFAMessageTemplateResource(
            $appId,
            $msgId
        ))
            ->setLanguage($language)
            ->setPinLength($pinLength)
            ->setRegional($regional)
            ->setRepeatDTMF($repeatDTMF)
            ->setSenderId($senderId)
            ->setSpeechRate($speechRate)
            ->setPinType($pinType)
            ->setMessageText($messageText);

        // assert
        $this->assertSame($expectedArray, $updateTwoFAMessageTemplateResource->payload());
        $this->assertSame($appId, $updateTwoFAMessageTemplateResource->getAppId());
        $this->assertSame($msgId, $updateTwoFAMessageTemplateResource->getMsgId());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $appId = 'appId';
        $msgId = 'msgId';
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
        $updateTwoFAMessageTemplateResource = (new UpdateTwoFAMessageTemplateResource(
            $appId,
            $msgId
        ))
            ->setLanguage($language)
            ->setPinLength($pinLength)
            ->setPinType($pinType)
            ->setMessageText($messageText);

        // assert
        $this->assertSame($expectedArray, $updateTwoFAMessageTemplateResource->payload());
        $this->assertSame($appId, $updateTwoFAMessageTemplateResource->getAppId());
        $this->assertSame($msgId, $updateTwoFAMessageTemplateResource->getMsgId());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $appId = 'appId';
        $msgId = 'msgId';

        // act
        $updateTwoFAMessageTemplateResource = new UpdateTwoFAMessageTemplateResource(
            $appId,
            $msgId
        );

        // assert
        $this->assertSame($appId, $updateTwoFAMessageTemplateResource->getAppId());
        $this->assertSame($msgId, $updateTwoFAMessageTemplateResource->getMsgId());
    }
}
