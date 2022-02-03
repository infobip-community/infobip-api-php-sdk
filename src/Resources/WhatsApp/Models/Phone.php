<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class Phone implements ModelInterface
{
    /** @var string|null */
    private $phone = null;

    /** @var string|null */
    private $type = null;

    /** @var string|null */
    private $whatsAppId = null;

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function setWhatsAppId(?string $whatsAppId): void
    {
        $this->whatsAppId = $whatsAppId;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'phone' => $this->phone,
            'type' => $this->type,
            'waId' => $this->whatsAppId,
        ]);
    }
}
