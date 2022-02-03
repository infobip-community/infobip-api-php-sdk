<?php

declare(strict_types=1);

namespace Infobip\Endpoints;

use Infobip\InfobipClient;

abstract class BaseEndpoint
{
    /** @var InfobipClient */
    protected $client;

    public function __construct(InfobipClient $client)
    {
        $this->client = $client;
    }
}
