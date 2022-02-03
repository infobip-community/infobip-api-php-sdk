<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\Contact;

final class ContactCollection extends BaseCollection
{
    public function add(Contact $contact): void
    {
        $this->items[] = $contact;
    }
}
