<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

abstract class BaseRule implements Rule
{
    /** @var string */
    protected $attribute;

    public function attribute(): string
    {
        return $this->attribute;
    }
}
