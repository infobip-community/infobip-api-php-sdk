<?php

declare(strict_types=1);

namespace Infobip\Resources\WebRTC\Enums;

use MyCLabs\Enum\Enum;

final class Recording extends Enum
{
    public const ALWAYS = 'ALWAYS';
    public const ON_DEMAND = 'ON_DEMAND';
    public const DISABLED = 'DISABLED';
}
