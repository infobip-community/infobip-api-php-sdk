<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

final class MinLengthRule extends BaseRule
{
    /** @var string|null */
    private $value;

    /** @var int */
    private $minLength;

    public function __construct(string $attribute, ?string $value, int $minLength)
    {
        $this->attribute = $attribute;
        $this->value = $value;
        $this->minLength = $minLength;
    }

    public function passes(): bool
    {
        if (is_null($this->value)) {
            return true;
        }

        if (mb_strlen($this->value, 'UTF-8') >= $this->minLength) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return sprintf(
            'Attribute "%s" must be minimum %d characters long.',
            $this->attribute,
            $this->minLength
        );
    }
}
