<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Contracts\InteractiveButtonsInterface;

final class InteractiveButtonCollection extends BaseCollection
{
    public function add(InteractiveButtonsInterface $interactiveButton): void
    {
        $this->items[] = $interactiveButton;
    }
}
