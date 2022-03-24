<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

final class Placeholder
{
    /** @var string */
    private $propertyName;

    /** @var string */
    private $value;

    public function __construct(string $propertyName, string $value)
    {
        $this->propertyName = $propertyName;
        $this->value = $value;
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
