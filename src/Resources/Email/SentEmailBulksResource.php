<?php

declare(strict_types=1);

namespace Infobip\Resources\Email;

use Infobip\Resources\ResourceQueryOptionsInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/email/get-scheduled-emails
 */
final class SentEmailBulksResource implements ResourceQueryOptionsInterface
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
            'bulkId' => $this->bulkId,
        ]);
    }
}
