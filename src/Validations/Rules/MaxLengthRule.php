<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

final class MaxLengthRule extends BaseRule
{
    /** @var string|null */
    private $value;

    /** @var int */
    private $maxLength;

    public function __construct(string $attribute, ?string $value, int $maxLength)
    {
        $this->attribute = $attribute;
        $this->value = $value;
        $this->maxLength = $maxLength;
    }

    public function passes(): bool
    {
        if (is_null($this->value)) {
            return true;
        }

        if (mb_strlen($this->value, 'UTF-8') <= $this->maxLength) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return sprintf(
            'Attribute "%s" must be maximum %d characters long.',
            $this->attribute,
            $this->maxLength
        );
    }
}
