<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;

final class PlaceholderCollection extends BaseCollection
{
    public function add(string $placeholder): void
    {
        $this->items[] = $placeholder;
    }
}
