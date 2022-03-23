<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Collections;

use Infobip\Resources\CollectionInterface;
use Infobip\Resources\SMS\Models\Placeholder;

final class PlaceholderCollection implements CollectionInterface
{
    /** @var array|string[] */
    private $items = [];

    public function add(Placeholder $placeholder): self
    {
        $this->items[$placeholder->getPropertyName()] = $placeholder->getValue();

        return $this;
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
