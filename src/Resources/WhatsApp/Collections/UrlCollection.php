<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\Url;

final class UrlCollection extends BaseCollection
{
    public function add(Url $url): void
    {
        $this->items[] = $url;
    }
}
