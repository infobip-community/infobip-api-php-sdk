<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Enums;

use MyCLabs\Enum\Enum;

final class NotifyContentType extends Enum
{
    public const APPLICATION_JSON = 'application/json';
    public const APPLICATION_XML = 'application/xml';
}
