<?php

declare(strict_types=1);

namespace Infobip\Resources\MMS;

use Infobip\Resources\ResourceQueryOptionsInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/mms/get-inbound-mms-messages
 */
final class GetInboundMMSMessagesResource implements ResourceQueryOptionsInterface
{
    /** @var int|null */
    private $limit = null;

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'limit' => $this->limit,
        ]);
    }
}
