<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\SMS\Models\Destination;

final class DestinationCollection extends BaseCollection
{
    public function add(Destination $destination): self
    {
        $this->items[] = $destination;

        return $this;
    }
}
