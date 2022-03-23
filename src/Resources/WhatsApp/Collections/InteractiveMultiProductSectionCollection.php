<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\InteractiveMultiProductSection;

final class InteractiveMultiProductSectionCollection extends BaseCollection
{
    public function add(InteractiveMultiProductSection $section): self
    {
        $this->items[] = $section;

        return $this;
    }
}
