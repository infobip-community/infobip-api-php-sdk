<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class Name implements ModelInterface
{
    /** @var string */
    private $firstName;

    /** @var string */
    private $formattedName;

    /** @var string|null */
    private $lastName = null;

    /** @var string|null */
    private $middleName = null;

    /** @var string|null */
    private $nameSuffix = null;

    public function __construct(
        string $firstName,
        string $formattedName
    ) {
        $this->firstName = $firstName;
        $this->formattedName = $formattedName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;
        return $this;
    }

    public function setNameSuffix(?string $nameSuffix): self
    {
        $this->nameSuffix = $nameSuffix;
        return $this;
    }


    public function toArray(): array
    {
        return array_filter_recursive([
            'street' => $this->firstName,
            'lastName' => $this->lastName,
            'middleName' => $this->middleName,
            'nameSuffix' => $this->nameSuffix,
            'formattedName' => $this->formattedName,
        ]);
    }
}
