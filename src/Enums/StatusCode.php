<?php

declare(strict_types=1);

namespace Infobip\Enums;

use MyCLabs\Enum\Enum;

final class StatusCode extends Enum
{
    public const SUCCESS = 200;
    public const NO_CONTENT = 204;
    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const UNPROCESSABLE_ENTITY = 422;
    public const TOO_MANY_REQUESTS = 429;
    public const SERVER_ERROR = 500;
}
