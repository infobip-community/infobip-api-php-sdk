<?php

declare(strict_types=1);

namespace Infobip\Resources\Shared\Collections;

use Infobip\Resources\CollectionInterface;
use Infobip\Resources\Shared\Enums\Day;

final class DayCollection implements CollectionInterface
{
    /** @var array|Day[] */
    protected $items = [];

    public function add(Day $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function toArray(): array
    {
        return array_map(function (Day $item) {
            return $item->getValue();
        }, $this->items);
    }
}
