<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Collections\ContactCollection;

final class ContactContent implements ModelInterface
{
    /** @var ContactCollection */
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ContactCollection();
    }

    public function addContact(Contact $contact): self
    {
        $this->contacts->add($contact);
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'contacts' => $this->contacts->toArray(),
        ]);
    }
}
