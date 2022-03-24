<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Enums;

use MyCLabs\Enum\Enum;

final class GeneralStatusType extends Enum
{
    public const ACCEPTED = 'ACCEPTED';
    public const PENDING = 'PENDING';
    public const UNDELIVERABLE = 'UNDELIVERABLE';
    public const DELIVERED = 'DELIVERED';
    public const REJECTED = 'REJECTED';
    public const EXPIRED = 'EXPIRED';
}
