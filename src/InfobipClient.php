<?php

declare(strict_types=1);

namespace Infobip;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;
use GuzzleHttp\Exception\RequestException as GuzzleHttpRequestException;
use GuzzleHttp\RequestOptions;
use Infobip\Endpoints\WhatsApp;
use Infobip\Exceptions\InfobipExceptionFactory;
use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceQueryOptionsInterface;

final class InfobipClient
{
    /** @var GuzzleHttpClientInterface|null */
    private $client = null;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $baseUrl;

    /** @var float */
    private $timeout;

    /** @var WhatsApp */
    private $whatsApp;

    public function __construct(string $apiKey, string $baseUrl, float $timeout)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
        $this->timeout = $timeout;

        $this->whatsApp = new WhatsApp($this);
    }

    public function setClient(GuzzleHttpClientInterface $client): void
    {
        $this->client = $client;
    }

    public function getClient(): GuzzleHttpClientInterface
    {
        if (null === $this->client) {
            $this->createDefaultClient();
        }

        return $this->client;
    }

    public function post(string $endpoint, array $payload = []): array
    {
        $options = [
            RequestOptions::JSON => $payload,
        ];

        return $this->call('POST', $endpoint, $options);
    }

    public function get(string $endpoint, array $queryParams = []): array
    {
        $options = [
            RequestOptions::QUERY => $queryParams,
        ];

        return $this->call('GET', $endpoint, $options);
    }

    public function put(string $endpoint, array $payload = [], array $queryParams = []): array
    {
        $options = [
            RequestOptions::JSON => $payload,
            RequestOptions::QUERY => $queryParams,
        ];

        return $this->call('PUT', $endpoint, $options);
    }

    public function delete(string $endpoint, array $payload = []): array
    {
        $options = [
            RequestOptions::JSON => $payload,
        ];

        return $this->call('DELETE', $endpoint, $options);
    }

    public function head(string $endpoint): array
    {
        return $this->call('HEAD', $endpoint);
    }

    public function whatsApp(): WhatsApp
    {
        return $this->whatsApp;
    }

    private function createDefaultClient(): void
    {
        $client = new GuzzleHttpClient([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout,
        ]);

        $this->setClient($client);
    }

    /**
     * @throws \Infobip\Exceptions\InfobipException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function call(string $method, string $endpoint, array $options = []): array
    {
        $options = array_merge_recursive(
            $options,
            $this->getDefaultOptions()
        );

        try {
            $response = $this->getClient()->request($method, $endpoint, $options);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleHttpRequestException $exception) {
            throw InfobipExceptionFactory::make($exception);
        }
    }

    private function getDefaultOptions(): array
    {
        return [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'App '.$this->apiKey,
            ],
        ];
    }
}
