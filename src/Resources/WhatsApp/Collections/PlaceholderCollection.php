<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\CollectionInterface;

final class PlaceholderCollection implements CollectionInterface
{
    /** @var array|string[] */
    protected $items = [];

    public function add(string $placeholder): void
    {
        $this->items[] = $placeholder;
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
