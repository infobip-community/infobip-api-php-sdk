<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Enums;

use MyCLabs\Enum\Enum;

final class MessageContentType extends Enum
{
    public const TEXT = 'TEXT';
    public const FILE = 'FILE';
    public const CARD = 'CARD';
    public const CAROUSEL = 'CAROUSEL';
}
