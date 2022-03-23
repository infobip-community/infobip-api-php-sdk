<?php

declare(strict_types=1);

namespace Tests\Resources\WebRTC;

use Infobip\Resources\WebRTC\Models\Android;
use Infobip\Resources\WebRTC\Models\Ios;
use Infobip\Resources\WebRTC\UpdateWebRTCApplicationResource;
use Tests\TestCase;

final class UpdateWebRTCApplicationResourceTest extends TestCase
{
    public function testCanCreateResourceWithAllData(): void
    {
        // arrange
        $id = 'id';
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
        $updateWebRTCApplicationResource = (new UpdateWebRTCApplicationResource(
            $id,
            $name
        ))
            ->setDescription($description)
            ->setIos($ios)
            ->setAndroid($android)
            ->setAppToApp($appToApp)
            ->setAppToConversations($appToConversations)
            ->setAppToPhone($appToPhone);

        // assert
        $this->assertSame($expectedArray, $updateWebRTCApplicationResource->payload());
        $this->assertSame($id, $updateWebRTCApplicationResource->getId());
    }

    public function testCanCreateResourceWithPartialData(): void
    {
        // arrange
        $id = 'id';
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
        $updateWebRTCApplicationResource = (new UpdateWebRTCApplicationResource(
            $id,
            $name
        ))
            ->setDescription($description)
            ->setAppToApp($appToApp)
            ->setAppToConversations($appToConversations)
            ->setAppToPhone($appToPhone);

        // assert
        $this->assertSame($expectedArray, $updateWebRTCApplicationResource->payload());
        $this->assertSame($id, $updateWebRTCApplicationResource->getId());
    }

    public function testCanCreateResourceWithRequiredData(): void
    {
        // arrange
        $id = 'id';
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
        $updateWebRTCApplicationResource = new UpdateWebRTCApplicationResource(
            $id,
            $name
        );

        // assert
        $this->assertSame($expectedArray, $updateWebRTCApplicationResource->payload());
        $this->assertSame($id, $updateWebRTCApplicationResource->getId());
    }
}
