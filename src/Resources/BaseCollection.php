<?php

declare(strict_types=1);

namespace Infobip\Resources;

abstract class BaseCollection implements CollectionInterface
{
    /** @var array|ModelInterface[] */
    protected $items = [];

    public function __construct()
    {
        $this->items = [];
    }

    public function toArray(): array
    {
        return array_map(function (ModelInterface $item) {
            return $item->toArray();
        }, $this->items);
    }
}
