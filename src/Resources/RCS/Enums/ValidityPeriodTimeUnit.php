<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Enums;

use MyCLabs\Enum\Enum;

final class ValidityPeriodTimeUnit extends Enum
{
    public const SECONDS = 'SECONDS';
    public const MINUTES = 'MINUTES';
    public const HOURS = 'HOURS';
    public const DAYS = 'DAYS';
}
