<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Enums;

use MyCLabs\Enum\Enum;

final class TemplateButtonType extends Enum
{
    public const QUICK_REPLY = 'QUICK_REPLY';
    public const URL = 'URL';
}
