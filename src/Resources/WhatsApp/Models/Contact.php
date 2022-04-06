<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Collections\AddressCollection;
use Infobip\Resources\WhatsApp\Collections\EmailCollection;
use Infobip\Resources\WhatsApp\Collections\PhoneCollection;
use Infobip\Resources\WhatsApp\Collections\UrlCollection;
use Infobip\Validations\Rules;

final class Contact implements ModelInterface, ModelValidationInterface
{
    /** @var AddressCollection */
    private $addresses;

    /** @var \DateTimeImmutable|null */
    private $birthday = null;

    /** @var EmailCollection */
    private $emails;

    /** @var Name */
    private $name;

    /** @var Org|null */
    private $org = null;

    /** @var PhoneCollection */
    private $phones;

    /** @var UrlCollection  */
    private $urls;

    public function __construct(Name $name)
    {
        $this->name = $name;
        $this->addresses = new AddressCollection();
        $this->emails = new EmailCollection();
        $this->phones = new PhoneCollection();
        $this->urls = new UrlCollection();
    }

    public function setOrg(?Org $org): self
    {
        $this->org = $org;
        return $this;
    }

    public function addAddress(Address $address): self
    {
        $this->addresses->add($address);
        return $this;
    }

    public function addEmail(Email $email): self
    {
        $this->emails->add($email);
        return $this;
    }

    public function addPhone(Phone $phone): self
    {
        $this->phones->add($phone);
        return $this;
    }

    public function addUrl(Url $url): self
    {
        $this->urls->add($url);
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'addresses' => $this->addresses->toArray(),
            'birthday' => $this->birthday ? $this->birthday->format('Y-m-d') : null,
            'emails' => $this->emails->toArray(),
            'name' => $this->name,
            'org' => $this->org,
            'phones' => $this->phones->toArray(),
            'urls' => $this->urls->toArray(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addCollectionRules($this->emails)
            ->addCollectionRules($this->urls);
    }
}
