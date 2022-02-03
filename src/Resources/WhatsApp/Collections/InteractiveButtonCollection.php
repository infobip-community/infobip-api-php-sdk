<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\InteractiveButton;

final class InteractiveButtonCollection extends BaseCollection
{
    public function add(InteractiveButton $interactiveButton): void
    {
        $this->items[] = $interactiveButton;
    }
}
