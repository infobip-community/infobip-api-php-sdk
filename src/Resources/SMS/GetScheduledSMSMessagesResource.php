<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourceQueryOptionsInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/get-scheduled-sms-messages
 */
final class GetScheduledSMSMessagesResource implements ResourceQueryOptionsInterface
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
