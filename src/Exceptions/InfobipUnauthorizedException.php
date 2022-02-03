<?php

declare(strict_types=1);

namespace Infobip\Exceptions;

use Infobip\Enums\StatusCode;
use Throwable;

final class InfobipUnauthorizedException extends InfobipException
{
    public static function create(string $message, Throwable $previous = null): self
    {
        return new self(
            $message,
            StatusCode::UNAUTHORIZED,
            $previous
        );
    }
}
