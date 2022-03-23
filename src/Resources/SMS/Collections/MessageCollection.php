<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\SMS\Models\Message;

final class MessageCollection extends BaseCollection
{
    public function add(Message $message): self
    {
        $this->items[] = $message;

        return $this;
    }
}
