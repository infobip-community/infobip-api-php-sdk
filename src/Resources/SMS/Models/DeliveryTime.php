<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;

final class DeliveryTime implements ModelInterface
{
    /** @var int|null */
    private $hour;

    /** @var int|null */
    private $minute;

    public function setHour(?int $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function setMinute(?int $minute): self
    {
        $this->minute = $minute;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'hour' => $this->hour,
            'minute' => $this->minute,
        ]);
    }
}
