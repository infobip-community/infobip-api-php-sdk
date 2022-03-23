<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Contracts\CreateTemplateButtonInterface;

final class CreateTemplateButtonCollection extends BaseCollection
{
    public function add(CreateTemplateButtonInterface $button): self
    {
        $this->items[] = $button;

        return $this;
    }
}
