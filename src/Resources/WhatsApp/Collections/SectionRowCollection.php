<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\SectionRow;

final class SectionRowCollection extends BaseCollection
{
    public function add(SectionRow $sectionRow): void
    {
        $this->items[] = $sectionRow;
    }
}
