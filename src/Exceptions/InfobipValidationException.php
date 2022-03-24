<?php

declare(strict_types=1);

namespace Infobip\Exceptions;

use Infobip\Enums\StatusCode;
use Throwable;

final class InfobipValidationException extends InfobipException
{
    public static function create(string $message, array $validationErrors): self
    {
        return new self(
            $message,
            StatusCode::UNPROCESSABLE_ENTITY,
            null,
            $validationErrors
        );
    }
}
