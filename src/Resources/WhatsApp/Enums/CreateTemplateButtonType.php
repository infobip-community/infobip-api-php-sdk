<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Enums;

use MyCLabs\Enum\Enum;

final class CreateTemplateButtonType extends Enum
{
    public const PHONE_NUMBER = 'PHONE_NUMBER';
    public const URL = 'URL';
    public const QUICK_REPLY = 'QUICK_REPLY';
}
