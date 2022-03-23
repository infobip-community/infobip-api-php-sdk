<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Enums;

use MyCLabs\Enum\Enum;

final class TrackingType extends Enum
{
    public const ONE_TIME_PIN = 'ONE_TIME_PIN';
    public const SOCIAL_INVITES = 'SOCIAL_INVITES';
}
