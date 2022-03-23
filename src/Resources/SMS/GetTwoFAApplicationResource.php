<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-2fa-application
 */
final class GetTwoFAApplicationResource
{
    /** @var string */
    private $appId;

    public function __construct(string $appId)
    {
        $this->appId = $appId;
    }

    public function getAppId(): string
    {
        return $this->appId;
    }
}
