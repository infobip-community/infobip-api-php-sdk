<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;

final class Destination implements ModelInterface
{
    /** @var string */
    private $to;

    /** @var string|null */
    private $messageId;

    public function __construct(string $to)
    {
        $this->to = $to;
    }

    public function setMessageId(?string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'messageId' => $this->messageId,
            'to' => $this->to,
        ]);
    }
}
