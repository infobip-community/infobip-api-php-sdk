<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Enums;

use MyCLabs\Enum\Enum;

final class PhoneType extends Enum
{
    public const CELL = 'CELL';
    public const MAIN = 'MAIN';
    public const IPHONE = 'IPHONE';
    public const HOME = 'HOME';
    public const WORK = 'WORK';
}
