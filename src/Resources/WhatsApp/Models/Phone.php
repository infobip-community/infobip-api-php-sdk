<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Enums\PhoneType;

final class Phone implements ModelInterface
{
    /** @var string */
    private $phone;

    /** @var PhoneType */
    private $type;

    /** @var string */
    private $whatsAppId;

    public function __construct(string $phone, PhoneType $type, string $whatsAppId)
    {
        $this->phone = $phone;
        $this->type = $type;
        $this->whatsAppId = $whatsAppId;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'phone' => $this->phone,
            'type' => $this->type->getValue(),
            'waId' => $this->whatsAppId,
        ]);
    }
}
