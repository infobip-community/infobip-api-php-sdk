<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Enums;

use MyCLabs\Enum\Enum;

final class TemplateHeaderType extends Enum
{
    public const TEXT = 'TEXT';
    public const DOCUMENT = 'DOCUMENT';
    public const IMAGE = 'IMAGE';
    public const VIDEO = 'VIDEO';
    public const LOCATION = 'LOCATION';
}
