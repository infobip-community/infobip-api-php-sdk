<?php

declare(strict_types=1);

namespace Infobip\Resources\Shared\Models;

use Infobip\Resources\ModelInterface;

final class TimeWindowFrom implements ModelInterface
{
    /** @var int */
    private $hour;

    /** @var int */
    private $minute;

    public function __construct(int $hour, int $minute)
    {
        $this->hour = $hour;
        $this->minute = $minute;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'hour' => $this->hour,
            'minute' => $this->minute,
        ]);
    }
}
