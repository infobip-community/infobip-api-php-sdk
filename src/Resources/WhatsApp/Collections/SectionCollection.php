<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\Section;

final class SectionCollection extends BaseCollection
{
    public function add(Section $section): void
    {
        $this->items[] = $section;
    }
}
