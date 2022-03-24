<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Enums;

use MyCLabs\Enum\Enum;

final class TimeUnitType extends Enum
{
    public const MINUTE = 'MINUTE';
    public const HOUR = 'HOUR';
    public const DAY = 'DAY';
}
