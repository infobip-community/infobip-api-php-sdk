<?php

declare(strict_types=1);

namespace Infobip\Enums;

final class StatusCode
{
    public const SUCCESS = 200;
    public const NO_CONTENT = 204;
    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const TOO_MANY_REQUESTS = 429;
    public const SERVER_ERROR = 500;
}
