<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\SMS\Models\TwoFAApplicationConfiguration;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/create-2fa-application
 */
final class CreateTwoFAApplicationResource implements ResourcePayloadInterface
{
    /** @var string */
    private $name;

    /** @var TwoFAApplicationConfiguration|null */
    private $configuration;

    /** @var bool|null */
    private $enabled;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setConfiguration(?TwoFAApplicationConfiguration $configuration): self
    {
        $this->configuration = $configuration;

        return $this;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'configuration' => $this->configuration ? $this->configuration->toArray() : null,
            'enabled' => $this->enabled,
            'name' => $this->name
        ]);
    }
}
