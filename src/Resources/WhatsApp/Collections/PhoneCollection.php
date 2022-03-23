<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\Phone;

final class PhoneCollection extends BaseCollection
{
    public function add(Phone $phone): self
    {
        $this->items[] = $phone;

        return $this;
    }
}
