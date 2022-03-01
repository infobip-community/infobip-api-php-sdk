<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Enums;

use MyCLabs\Enum\Enum;

final class CreateTemplateHeaderType extends Enum
{
    public const TEXT = 'TEXT';
    public const IMAGE = 'IMAGE';
    public const VIDEO = 'VIDEO';
    public const DOCUMENT = 'DOCUMENT';
    public const LOCATION = 'LOCATION';
}
