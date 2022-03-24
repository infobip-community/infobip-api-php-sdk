<?php

declare(strict_types=1);

namespace Tests;

use GuzzleHttp\Client as GuzzleHttpClient;
use Infobip\Endpoints\Email;
use Infobip\Endpoints\MMS;
use Infobip\Endpoints\RCS;
use Infobip\Endpoints\SMS;
use Infobip\Endpoints\WebRTC;
use Infobip\Endpoints\WhatsApp;
use Infobip\InfobipClient;

final class InfobipClientTest extends TestCase
{
    public function testClientCanBeCreatedWithEndpoints(): void
    {
        // arrange & act
        $client = $this->getInfobipClient();

        // assert
        $this->assertInstanceOf(RCS::class, $client->RCS());
        $this->assertInstanceOf(WebRTC::class, $client->webRTC());
        $this->assertInstanceOf(WhatsApp::class, $client->whatsApp());
        $this->assertInstanceOf(SMS::class, $client->SMS());
        $this->assertInstanceOf(MMS::class, $client->MMS());
        $this->assertInstanceOf(Email::class, $client->email());
    }

    public function testDefaultGuzzleHttpClientIsCreatedAutomatically(): void
    {
        // arrange & act
        $client = $this->getInfobipClient();

        // assert
        $this->assertInstanceOf(GuzzleHttpClient::class, $client->getClient());
    }

    public function testGuzzleHttpClientCanBeSetManually(): void
    {
        // arrange
        $guzzleHttpClient = new GuzzleHttpClient();

        // act
        $client = $this->getInfobipClient();
        $client->setClient($guzzleHttpClient);
        $manuallyCreatedGuzzleHttpClient = $client->getClient();

        // assert
        $this->assertInstanceOf(GuzzleHttpClient::class, $manuallyCreatedGuzzleHttpClient);
        $this->assertEquals($guzzleHttpClient, $manuallyCreatedGuzzleHttpClient);
        $this->assertSame($guzzleHttpClient, $manuallyCreatedGuzzleHttpClient);
    }

    public function testGuzzleHttpClientCanBeOverridden(): void
    {
        // arrange
        $guzzleHttpClient = new GuzzleHttpClient();

        // act
        $client = $this->getInfobipClient();
        $defaultGuzzleHttpClient = $client->getClient();

        $client->setClient($guzzleHttpClient);
        $overriddenGuzzleHttpClient = $client->getClient();

        // assert
        $this->assertInstanceOf(GuzzleHttpClient::class, $defaultGuzzleHttpClient);
        $this->assertInstanceOf(GuzzleHttpClient::class, $overriddenGuzzleHttpClient);
        $this->assertNotEquals($defaultGuzzleHttpClient, $overriddenGuzzleHttpClient);
        $this->assertNotSame($defaultGuzzleHttpClient, $overriddenGuzzleHttpClient);
    }

    private function getInfobipClient(): InfobipClient
    {
        $apiKey = 'apiKey';
        $baseUrl = 'https://xxxxx.api.infobip.com/';
        $timeout = 0;

        return new InfobipClient($apiKey, $baseUrl, $timeout);
    }
}
