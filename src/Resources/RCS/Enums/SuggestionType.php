<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Enums;

use MyCLabs\Enum\Enum;

final class SuggestionType extends Enum
{
    public const REPLY = 'REPLY';
    public const OPEN_URL = 'OPEN_URL';
    public const DIAL_PHONE = 'DIAL_PHONE';
    public const SHOW_LOCATION = 'SHOW_LOCATION';
    public const REQUEST_LOCATION = 'REQUEST_LOCATION';
}
