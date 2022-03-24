<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\SMS\Models\TwoFAApplicationConfiguration;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/update-2fa-application
 */
final class UpdateTwoFAApplicationResource implements ResourcePayloadInterface
{
    /** @var string */
    private $appId;

    /** @var string */
    private $name;

    /** @var TwoFAApplicationConfiguration|null */
    private $configuration;

    /** @var bool|null */
    private $enabled;

    public function __construct(string $appId, string $name)
    {
        $this->appId = $appId;
        $this->name = $name;
    }

    public function getAppId(): string
    {
        return $this->appId;
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
            'configuration' => $this->configuration,
            'enabled' => $this->enabled,
            'name' => $this->name
        ]);
    }
}
