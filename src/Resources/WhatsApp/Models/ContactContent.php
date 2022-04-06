<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\WhatsApp\Collections\ContactCollection;
use Infobip\Resources\WhatsApp\Contracts\ContentInterface;
use Infobip\Validations\Rules;

final class ContactContent implements ContentInterface
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

    public function rules(): Rules
    {
        return (new Rules())
            ->addCollectionRules($this->contacts);
    }
}
