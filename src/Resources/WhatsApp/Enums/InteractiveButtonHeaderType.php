<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Enums;

use MyCLabs\Enum\Enum;

final class InteractiveButtonHeaderType extends Enum
{
    public const TEXT = 'TEXT';
    public const VIDEO = 'VIDEO';
    public const IMAGE = 'IMAGE';
    public const DOCUMENT = 'DOCUMENT';
}
