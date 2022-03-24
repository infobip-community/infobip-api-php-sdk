<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

final class MinNumberRule extends BaseRule
{
    /** @var float|int|null */
    private $value;

    /** @var float|int */
    private $min;

    public function __construct(string $attribute, ?float $value, float $min)
    {
        $this->attribute = $attribute;
        $this->value = $value;
        $this->min = $min;
    }

    public function passes(): bool
    {
        if (is_null($this->value)) {
            return true;
        }

        if ($this->value >= $this->min) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return sprintf(
            'Attribute "%s" must be minimum %s.',
            $this->attribute,
            $this->min
        );
    }
}
