<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

final class MaxNumberRule extends BaseRule
{
    /** @var float|int|null */
    private $value;

    /** @var float|int */
    private $max;

    public function __construct(string $attribute, ?float $value, float $max)
    {
        $this->attribute = $attribute;
        $this->value = $value;
        $this->max = $max;
    }

    public function passes(): bool
    {
        if (is_null($this->value)) {
            return true;
        }

        if ($this->value <= $this->max) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return sprintf(
            'Attribute "%s" must be maximum %s.',
            $this->attribute,
            $this->max
        );
    }
}
