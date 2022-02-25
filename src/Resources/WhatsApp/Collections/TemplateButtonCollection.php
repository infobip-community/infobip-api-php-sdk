<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Contracts\TemplateButtonInterface;

final class TemplateButtonCollection extends BaseCollection
{
    public function add(TemplateButtonInterface $templateButton): void
    {
        $this->items[] = $templateButton;
    }
}
