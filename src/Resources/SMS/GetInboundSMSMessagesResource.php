<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourceQueryOptionsInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-inbound-sms-messages
 */
final class GetInboundSMSMessagesResource implements ResourceQueryOptionsInterface
{
    /** @var int|null */
    private $limit;

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'limit' => $this->limit
        ]);
    }
}
