<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\CollectionInterface;

final class PlaceholderCollection implements CollectionInterface
{
    /** @var array|string[] */
    protected $items = [];

    public function add(string $placeholder): self
    {
        $this->items[] = $placeholder;

        return $this;
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
