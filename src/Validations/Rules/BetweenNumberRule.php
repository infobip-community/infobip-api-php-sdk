<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

final class BetweenNumberRule extends BaseRule
{
    /** @var float|int|null */
    private $value;

    /** @var float|int */
    private $min;

    /** @var float|int */
    private $max;

    public function __construct(string $attribute, ?float $value, float $min, float $max)
    {
        $this->attribute = $attribute;
        $this->value = $value;
        $this->min = $min;
        $this->max = $max;
    }

    public function passes(): bool
    {
        if (is_null($this->value)) {
            return true;
        }

        $minNumberRule = new MinNumberRule($this->attribute, $this->value, $this->min);
        $maxNumberRule = new MaxNumberRule($this->attribute, $this->value, $this->max);

        if (
            true === $minNumberRule->passes()
            && true === $maxNumberRule->passes()
        ) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return sprintf(
            'Attribute "%s" must be between %g and %g.',
            $this->attribute,
            $this->min,
            $this->max
        );
    }
}
