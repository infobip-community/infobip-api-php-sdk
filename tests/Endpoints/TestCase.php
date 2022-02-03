<?php

declare(strict_types=1);

namespace Tests\Endpoints;

use Tests\TestCase as BaseTestCase;
use Infobip\InfobipClient;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

abstract class TestCase extends BaseTestCase
{
    /** @var InfobipClient */
    private $infobipClient;

    protected function setUp(): void
    {
        $this->infobipClient = new InfobipClient(
            'apiKey',
            'https://xxxxx.api.infobip.com/',
            1
        );

        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->infobipClient);

        parent::tearDown();
    }

    protected function setMockedGuzzleHttpClient(int $statusCode, array $responseBody = []): void
    {
        $mockedResponse = new Response($statusCode, [], json_encode($responseBody));
        $mockHandler = new MockHandler([$mockedResponse]);
        $handlerStack = HandlerStack::create($mockHandler);

        $mockedGuzzleHttpClient = new GuzzleHttpClient([
            'handler' => $handlerStack,
        ]);

        $this->getInfobipClient()->setClient($mockedGuzzleHttpClient);
    }

    protected function getInfobipClient(): InfobipClient
    {
        return $this->infobipClient;
    }

    protected function loadJsonDataFixture(string $path): array
    {
        $jsonFile = file_get_contents(__DIR__ . '/../DataFixtures/' . ltrim($path, '/'));

        return json_decode($jsonFile, true);
    }
}
