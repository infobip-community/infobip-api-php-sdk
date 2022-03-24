<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-scheduled-sms-messages-status
 */
use Infobip\Resources\ResourceQueryOptionsInterface;

final class GetScheduledSMSMessagesStatusResource implements ResourceQueryOptionsInterface
{
    /** @var string */
    private $bulkId;

    public function __construct(string $bulkId)
    {
        $this->bulkId = $bulkId;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'bulkId' => $this->bulkId
        ]);
    }
}
