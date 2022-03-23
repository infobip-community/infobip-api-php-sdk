<?php

declare(strict_types=1);

namespace Infobip\Resources\Email;

use Infobip\Resources\ResourceQueryOptionsInterface;

/**
 * @link https://www.infobip.com/docs/api#channels/email/get-email-logs
 */
final class EmailLogsResource implements ResourceQueryOptionsInterface
{
    /** @var string|null */
    private $messageId = null;

    /** @var string|null */
    private $from = null;

    /** @var string|null */
    private $to = null;

    /** @var string|null */
    private $bulkId = null;

    /** @var string|null */
    private $generalStatus = null;

    /** @var string|null */
    private $sentSince = null;

    /** @var string|null */
    private $sentUntil = null;

    /** @var int|null */
    private $limit = null;

    public function setMessageId(?string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function setFrom(?string $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function setTo(?string $to): self
    {
        $this->to = $to;

        return $this;
    }

    public function setBulkId(?string $bulkId): self
    {
        $this->bulkId = $bulkId;

        return $this;
    }

    public function setGeneralStatus(?string $generalStatus): self
    {
        $this->generalStatus = $generalStatus;

        return $this;
    }

    public function setSentSince(?string $sentSince): self
    {
        $this->sentSince = $sentSince;

        return $this;
    }

    public function setSentUntil(?string $sentUntil): self
    {
        $this->sentUntil = $sentUntil;

        return $this;
    }

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function queryOptions(): array
    {
        return array_filter_recursive([
            'messageId' => $this->messageId,
            'from' => $this->from,
            'to' => $this->to,
            'bulkId' => $this->bulkId,
            'generalStatus' => $this->generalStatus,
            'sentSince' => $this->sentSince,
            'sentUntil' => $this->sentUntil,
            'limit' => $this->limit,
        ]);
    }
}
