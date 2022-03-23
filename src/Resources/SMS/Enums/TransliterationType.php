<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Enums;

use MyCLabs\Enum\Enum;

final class TransliterationType extends Enum
{
    public const TURKISH = 'TURKISH';
    public const GREEK = 'GREEK';
    public const CYRILLIC = 'CYRILLIC';
    public const SERBIAN_CYRILLIC = 'SERBIAN_CYRILLIC';
    public const CENTRAL_EUROPEAN = 'CENTRAL_EUROPEAN';
    public const BALTIC = 'BALTIC';
    public const NON_UNICODE = 'NON_UNICODE';
}
