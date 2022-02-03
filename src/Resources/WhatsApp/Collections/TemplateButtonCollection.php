<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\TemplateButton;

final class TemplateButtonCollection extends BaseCollection
{
    public function add(TemplateButton $templateButton): void
    {
        $this->items[] = $templateButton;
    }
}
