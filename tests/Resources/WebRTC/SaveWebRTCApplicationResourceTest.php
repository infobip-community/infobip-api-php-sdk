<?php

declare(strict_types=1);

namespace Tests\Resources\WebRTC;

use Infobip\Resources\WebRTC\Models\Android;
use Infobip\Resources\WebRTC\Models\Ios;
use Infobip\Resources\WebRTC\SaveWebRTCApplicationResource;
use Tests\TestCase;

final class SaveWebRTCApplicationResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $name = 'name';
        $description = 'description';
        $ios = new Ios('fcmServerKey');
        $android = new Android('apnsCertificateFilename', 'apnsCertificateFileContent');
        $appToApp = true;
        $appToConversations = true;
        $appToPhone = false;

        $expectedArray = [
            'name' => $name,
            'description' => $description,
            'ios' => $ios->toArray(),
            'android' => $android->toArray(),
            'appToApp' => $appToApp,
            'appToConversations' => $appToConversations,
            'appToPhone' => $appToPhone,
        ];

        // act
        $saveWebRTCApplicationResource = (new SaveWebRTCApplicationResource($name))
            ->setDescription($description)
            ->setIos($ios)
            ->setAndroid($android)
            ->setAppToApp($appToApp)
            ->setAppToConversations($appToConversations)
            ->setAppToPhone($appToPhone);

        // assert
        $this->assertSame($expectedArray, $saveWebRTCApplicationResource->payload());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $name = 'name';
        $description = 'description';
        $appToApp = true;
        $appToConversations = true;
        $appToPhone = false;

        $expectedArray = [
            'name' => $name,
            'description' => $description,
            'appToApp' => $appToApp,
            'appToConversations' => $appToConversations,
            'appToPhone' => $appToPhone,
        ];

        // act
        $saveWebRTCApplicationResource = (new SaveWebRTCApplicationResource($name))
            ->setDescription($description)
            ->setAppToApp($appToApp)
            ->setAppToConversations($appToConversations)
            ->setAppToPhone($appToPhone);

        // assert
        $this->assertSame($expectedArray, $saveWebRTCApplicationResource->payload());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $name = 'name';
        $appToApp = false;
        $appToConversations = false;
        $appToPhone = false;

        $expectedArray = [
            'name' => $name,
            'appToApp' => $appToApp,
            'appToConversations' => $appToConversations,
            'appToPhone' => $appToPhone,
        ];

        // act
        $saveWebRTCApplicationResource = new SaveWebRTCApplicationResource($name);

        // assert
        $this->assertSame($expectedArray, $saveWebRTCApplicationResource->payload());
    }
}
