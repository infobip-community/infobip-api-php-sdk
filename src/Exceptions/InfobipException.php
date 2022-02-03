<?php

declare(strict_types=1);

namespace Infobip\Exceptions;

use Exception;
use Throwable;

class InfobipException extends Exception
{
    /** @var array */
    protected $validationErrors;

    public function __construct(
        string $message = '',
        int $code = 0,
        Throwable $previous = null,
        array $validationErrors = []
    ) {
        $this->validationErrors = $validationErrors;

        parent::__construct($message, $code, $previous);
    }

    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}
