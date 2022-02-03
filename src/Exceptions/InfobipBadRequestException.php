<?php

declare(strict_types=1);

namespace Infobip\Exceptions;

use Infobip\Enums\StatusCode;
use Throwable;

final class InfobipBadRequestException extends InfobipException
{
    public static function create(string $message, array $validationErrors, Throwable $previous = null): self
    {
        return new self(
            $message,
            StatusCode::BAD_REQUEST,
            $previous,
            $validationErrors
        );
    }
}
