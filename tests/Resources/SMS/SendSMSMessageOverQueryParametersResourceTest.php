<?php

declare(strict_types=1);

namespace Tests\Resources\SMS;

use Infobip\Resources\SMS\Enums\NotifyContentType;
use Infobip\Resources\SMS\Enums\TransliterationType;
use Infobip\Resources\SMS\SendSMSMessageOverQueryParametersResource;
use Tests\TestCase;

final class SendSMSMessageOverQueryParametersResourceTest extends TestCase
{
    public function testCanResourceWithAllData(): void
    {
        // arrange
        $username = 'username';
        $password = 'password';
        $bulkId = 'bulkId';
        $from = 'from';
        $to = ['to1', 'to2'];
        $text = 'text';
        $flash = true;
        $transliteration = new TransliterationType(TransliterationType::CENTRAL_EUROPEAN);
        $languageCode = 'languageCode';
        $intermediateReport = true;
        $notifyUrl = 'notifyUrl';
        $notifyContentType = new NotifyContentType(NotifyContentType::APPLICATION_JSON);
        $callbackData = 'callbackData';
        $validityPeriod = 5;
        $sendAt = 'sendAt';
        $track = 'track';
        $processKey = 'processKey';
        $trackingType = 'trackingType';
        $indiaDltContentTemplateId = 'indiaDltContentTemplateId';
        $indiaDltPrincipalEntityId = 'indiaDltPrincipalEntityId';

        $expectedArray = [
            'username' => $username,
            'password' => $password,
            'bulkId' => $bulkId,
            'from' => $from,
            'to' => $to,
            'text' => $text,
            'flash' => $flash,
            'transliteration' => $transliteration->getValue(),
            'languageCode' => $languageCode,
            'intermediateReport' => $intermediateReport,
            'notifyUrl' => $notifyUrl,
            'notifyContentType' => $notifyContentType->getValue(),
            'callbackData' => $callbackData,
            'validityPeriod' => $validityPeriod,
            'sendAt' => $sendAt,
            'track' => $track,
            'processKey' => $processKey,
            'trackingType' => $trackingType,
            'indiaDltContentTemplateId' => $indiaDltContentTemplateId,
            'indiaDltPrincipalEntityId' => $indiaDltPrincipalEntityId,
        ];

        // act
        $sendSMSMessageOverQueryParametersResource = (new SendSMSMessageOverQueryParametersResource(
            $username,
            $password,
            $to
        ))
            ->setBulkId($bulkId)
            ->setFrom($from)
            ->setText($text)
            ->setFlash($flash)
            ->setTransliteration($transliteration)
            ->setLanguageCode($languageCode)
            ->setIntermediateReport($intermediateReport)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl)
            ->setNotifyContentType($notifyContentType)
            ->setValidityPeriod($validityPeriod)
            ->setSendAt($sendAt)
            ->setTrack($track)
            ->setProcessKey($processKey)
            ->setTrackingType($trackingType)
            ->setIndiaDltContentTemplateId($indiaDltContentTemplateId)
            ->setIndiaDltPrincipalEntityId($indiaDltPrincipalEntityId);

        // assert
        $this->assertSame($expectedArray, $sendSMSMessageOverQueryParametersResource->queryOptions());
    }

    public function testCanResourceWithPartialData(): void
    {
        // arrange
        $username = 'username';
        $password = 'password';
        $bulkId = 'bulkId';
        $from = 'from';
        $to = ['to1', 'to2'];
        $text = 'text';
        $flash = true;
        $transliteration = new TransliterationType(TransliterationType::CENTRAL_EUROPEAN);
        $languageCode = 'languageCode';
        $intermediateReport = true;
        $notifyUrl = 'notifyUrl';
        $notifyContentType = new NotifyContentType(NotifyContentType::APPLICATION_JSON);
        $callbackData = 'callbackData';
        $validityPeriod = 5;
        $sendAt = 'sendAt';

        $expectedArray = [
            'username' => $username,
            'password' => $password,
            'bulkId' => $bulkId,
            'from' => $from,
            'to' => $to,
            'text' => $text,
            'flash' => $flash,
            'transliteration' => $transliteration->getValue(),
            'languageCode' => $languageCode,
            'intermediateReport' => $intermediateReport,
            'notifyUrl' => $notifyUrl,
            'notifyContentType' => $notifyContentType->getValue(),
            'callbackData' => $callbackData,
            'validityPeriod' => $validityPeriod,
            'sendAt' => $sendAt
        ];

        // act
        $sendSMSMessageOverQueryParametersResource = (new SendSMSMessageOverQueryParametersResource(
            $username,
            $password,
            $to
        ))
            ->setBulkId($bulkId)
            ->setFrom($from)
            ->setText($text)
            ->setFlash($flash)
            ->setTransliteration($transliteration)
            ->setLanguageCode($languageCode)
            ->setIntermediateReport($intermediateReport)
            ->setCallbackData($callbackData)
            ->setNotifyUrl($notifyUrl)
            ->setNotifyContentType($notifyContentType)
            ->setValidityPeriod($validityPeriod)
            ->setSendAt($sendAt);

        // assert
        $this->assertSame($expectedArray, $sendSMSMessageOverQueryParametersResource->queryOptions());
    }

    public function testCanCreateCreateResourceWithRequiredData(): void
    {
        // arrange
        $username = 'username';
        $password = 'password';
        $to = ['to1', 'to2'];

        $expectedArray = [
            'username' => $username,
            'password' => $password,
            'to' => $to,
        ];

        // act
        $sendSMSMessageOverQueryParametersResource = new SendSMSMessageOverQueryParametersResource(
            $username,
            $password,
            $to
        );

        // assert
        $this->assertSame($expectedArray, $sendSMSMessageOverQueryParametersResource->queryOptions());
    }
}
