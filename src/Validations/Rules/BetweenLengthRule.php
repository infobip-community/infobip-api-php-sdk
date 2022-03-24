<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

final class BetweenLengthRule extends BaseRule
{
    /** @var string|null */
    private $value;

    /** @var int */
    private $minLength;

    /** @var int */
    private $maxLength;

    public function __construct(string $attribute, ?string $value, int $minLength, int $maxLength)
    {
        $this->attribute = $attribute;
        $this->value = $value;
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function passes(): bool
    {
        if (is_null($this->value)) {
            return true;
        }

        $minLengthRule = new MinLengthRule($this->attribute, $this->value, $this->minLength);
        $maxLengthRule = new MaxLengthRule($this->attribute, $this->value, $this->maxLength);

        if (
            true === $minLengthRule->passes()
            && true === $maxLengthRule->passes()
        ) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return sprintf(
            'Attribute "%s" must be between %d and %d characters long.',
            $this->attribute,
            $this->minLength,
            $this->maxLength
        );
    }
}
