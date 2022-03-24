<?php

declare(strict_types=1);

namespace Infobip;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;
use GuzzleHttp\Exception\RequestException as GuzzleHttpRequestException;
use GuzzleHttp\RequestOptions;
use Infobip\Endpoints\Email;
use Infobip\Endpoints\MMS;
use Infobip\Endpoints\RCS;
use Infobip\Endpoints\SMS;
use Infobip\Endpoints\WebRTC;
use Infobip\Endpoints\WhatsApp;
use Infobip\Exceptions\InfobipExceptionFactory;

final class InfobipClient
{
    /** @var GuzzleHttpClientInterface */
    private $client = null;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $baseUrl;

    /** @var float */
    private $timeout;

    /** @var WhatsApp */
    private $whatsApp;

    /** @var RCS */
    private $RCS;

    /** @var WebRTC */
    private $webRTC;

    /** @var SMS */
    private $SMS;

    /** @var Email */
    private $email;

    /** @var MMS */
    private $MMS;


    public function __construct(string $apiKey, string $baseUrl, float $timeout)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
        $this->timeout = $timeout;

        $this->whatsApp = new WhatsApp($this);
        $this->RCS = new RCS($this);
        $this->webRTC = new WebRTC($this);
        $this->SMS = new SMS($this);
        $this->email = new Email($this);
        $this->MMS = new MMS($this);
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

    public function post(string $endpoint, array $payload = [], array $queryParams = []): array
    {
        $options = [
            RequestOptions::JSON => $payload,
            RequestOptions::QUERY => $queryParams,
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

    public function RCS(): RCS
    {
        return $this->RCS;
    }

    public function webRTC(): WebRTC
    {
        return $this->webRTC;
    }

    public function SMS(): SMS
    {
        return $this->SMS;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function MMS(): MMS
    {
        return $this->MMS;
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

            return $this->getResponseBodyContents($response->getBody()->getContents());
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

    private function getResponseBodyContents(string $responseBodyContents): array
    {
        $jsonArray = json_decode($responseBodyContents, true);

        if (is_array($jsonArray)) {
            return $jsonArray;
        }

        return [];
    }
}
