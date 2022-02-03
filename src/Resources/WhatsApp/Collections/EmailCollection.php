<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\Email;

final class EmailCollection extends BaseCollection
{
    public function add(Email $email): void
    {
        $this->items[] = $email;
    }
}
