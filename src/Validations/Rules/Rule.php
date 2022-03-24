<?php

declare(strict_types=1);

namespace Infobip\Validations\Rules;

interface Rule
{
    public function passes(): bool;

    public function message(): string;

    public function attribute(): string;
}
