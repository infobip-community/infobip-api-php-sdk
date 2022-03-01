<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Enums;

use MyCLabs\Enum\Enum;

final class CreateTemplateCategoryType extends Enum
{
    public const ACCOUNT_UPDATE = 'ACCOUNT_UPDATE';
    public const PAYMENT_UPDATE = 'PAYMENT_UPDATE';
    public const PERSONAL_FINANCE_UPDATE = 'PERSONAL_FINANCE_UPDATE';
    public const SHIPPING_UPDATE = 'SHIPPING_UPDATE';
    public const RESERVATION_UPDATE = 'RESERVATION_UPDATE';
    public const ISSUE_RESOLUTION = 'ISSUE_RESOLUTION';
    public const APPOINTMENT_UPDATE = 'APPOINTMENT_UPDATE';
    public const TRANSPORTATION_UPDATE = 'TRANSPORTATION_UPDATE';
    public const TICKET_UPDATE = 'TICKET_UPDATE';
    public const ALERT_UPDATE = 'ALERT_UPDATE';
    public const AUTO_REPLY = 'AUTO_REPLY';
}
