<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\Address;

final class AddressCollection extends BaseCollection
{
    public function add(Address $item): self
    {
        $this->items[] = $item;

        return $this;
    }
}
