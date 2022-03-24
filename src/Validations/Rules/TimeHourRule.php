<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

final class TimeHourRule extends BaseRule
{
    /** @var int|null */
    private $value;

    /** @var int */
    private const MIN = 0;

    /** @var int */
    private const MAX = 23;

    public function __construct(string $attribute, ?int $value)
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
            'Attribute "%s" must be between %d and %d hours.',
            $this->attribute,
            self::MIN,
            self::MAX
        );
    }
}
