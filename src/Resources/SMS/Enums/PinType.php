<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Enums;

use MyCLabs\Enum\Enum;

final class PinType extends Enum
{
    public const NUMERIC = 'NUMERIC';
    public const ALPHA = 'ALPHA';
    public const HEX = 'HEX';
    public const ALPHANUMERIC = 'ALPHANUMERIC';
}
