<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;

final class SuggestionCollection extends BaseCollection
{
    public function add(SuggestionInterface $item): void
    {
        $this->items[] = $item;
    }
}
