<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

final class LongitudeRule extends BaseRule
{
    /** @var float|int|null */
    private $value;

    /** @var int */
    private const MIN = -180;

    /** @var int */
    private const MAX = 180;

    public function __construct(string $attribute, ?float $value)
    {
        $this->attribute = $attribute;
        $this->value = $value;
    }

    public function passes(): bool
    {
        if (is_null($this->value)) {
            return true;
        }

        $betweenNumberRule = new BetweenNumberRule($this->attribute, $this->value, self::MIN, self::MAX);

        if (true === $betweenNumberRule->passes()) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return sprintf(
            'Attribute "%s" must be between %g and %g degrees.',
            $this->attribute,
            self::MIN,
            self::MAX
        );
    }
}
