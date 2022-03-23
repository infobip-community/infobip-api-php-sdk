<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-2fa-message-template
 */
final class GetTwoFAMessageTemplateResource
{
    /** @var string */
    private $appId;

    /** @var string */
    private $msgId;

    public function __construct(string $appId, string $msgId)
    {
        $this->appId = $appId;
        $this->msgId = $msgId;
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    public function getMsgId(): string
    {
        return $this->msgId;
    }
}
