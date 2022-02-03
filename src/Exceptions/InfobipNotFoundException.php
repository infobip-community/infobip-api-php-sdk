<?php

declare(strict_types=1);

namespace Infobip\Exceptions;

use Infobip\Enums\StatusCode;
use Throwable;

final class InfobipNotFoundException extends InfobipException
{
    public static function create(string $message, Throwable $previous = null): self
    {
        return new self(
            $message,
            StatusCode::NOT_FOUND,
            $previous
        );
    }
}
