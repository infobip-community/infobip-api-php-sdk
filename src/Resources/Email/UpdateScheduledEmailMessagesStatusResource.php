<?php

declare(strict_types=1);

namespace Infobip\Resources\Email;

use Infobip\Resources\Email\Enums\Status;
use Infobip\Resources\ResourcePayloadInterface;
use Infobip\Resources\ResourceQueryOptionsInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/email/update-scheduled-email-statuses
 */
final class UpdateScheduledEmailMessagesStatusResource implements ResourceQueryOptionsInterface, ResourcePayloadInterface
{
    /** @var string */
    private $bulkId;

    /** @var Status */
    private $status;

    public function __construct(
        string $bulkId,
        Status $status
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
            'status' => $this->status->getValue(),
        ]);
    }
}
