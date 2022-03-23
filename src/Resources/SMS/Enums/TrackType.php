<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Enums;

use MyCLabs\Enum\Enum;

final class TrackType extends Enum
{
    public const SMS = 'SMS';
    public const URL = 'URL';
}
