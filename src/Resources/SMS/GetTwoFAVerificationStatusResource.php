<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourceQueryOptionsInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-2fa-verification-status
 */
final class GetTwoFAVerificationStatusResource implements ResourceQueryOptionsInterface
{
    /** @var string */
    private $appId;

    /** @var string */
    private $msisdn;

    /** @var bool|null */
    private $verified;

    /** @var bool|null */
    private $sent;

    public function __construct(string $appId, string $msisdn)
    {
        $this->appId = $appId;
        $this->msisdn = $msisdn;
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    public function setVerified(?bool $verified): self
    {
        $this->verified = $verified;

        return $this;
    }

    public function setSent(?bool $sent): self
    {
        $this->sent = $sent;

        return $this;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'msisdn' => $this->msisdn,
            'verified' => $this->verified,
            'sent' => $this->sent
        ]);
    }
}
