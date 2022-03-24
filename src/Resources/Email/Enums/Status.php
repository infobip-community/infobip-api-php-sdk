<?php

declare(strict_types=1);

namespace Infobip\Resources\Email\Enums;

use MyCLabs\Enum\Enum;

final class Status extends Enum
{
    public const PENDING = 'PENDING';
    public const PAUSED = 'PAUSED';
    public const PROCESSING = 'PROCESSING';
    public const CANCELED = 'CANCELED';
    public const FINISHED = 'FINISHED';
    public const FAILED = 'FAILED';
}
