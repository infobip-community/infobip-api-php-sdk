<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

final class EmailRule extends BaseRule
{
    /** @var string|null */
    private $value;

    public function __construct(string $attribute, ?string $value)
    {
        $this->attribute = $attribute;
        $this->value = $value;
    }

    public function passes(): bool
    {
        if (is_null($this->value)) {
            return true;
        }

        if (false !== filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return sprintf(
            'Attribute "%s" is not valid email address.',
            $this->attribute
        );
    }
}
