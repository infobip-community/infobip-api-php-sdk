<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS;

use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceQueryOptionsInterface;
use Infobip\Resources\SMS\Enums\StatusType;

/**
 * @link https://www.infobip.com/docs/api#channels/sms/update-scheduled-sms-messages-status
 */
final class UpdateScheduledSMSMessagesStatusResource implements
    ResourceQueryOptionsInterface,
    ResourcePayloadInterface
{
    /** @var string */
    private $bulkId;

    /** @var StatusType */
    private $status;

    public function __construct(
        string $bulkId,
        StatusType $status
    ) {
        $this->bulkId = $bulkId;
        $this->status = $status;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'bulkId' => $this->bulkId,
        ]);
    }

    public function payload(): array
    {
        return array_filter_recursive([
            'status' => $this->status->getValue()
        ]);
    }
}
