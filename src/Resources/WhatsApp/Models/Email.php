<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class Email implements ModelInterface
{
    /** @var string */
    private $email;

    /** @var string */
    private $type;

    public function __construct(
        string $email,
        string $type
    ) {
        $this->email = $email;
        $this->type = $type;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'email' => $this->email,
            'type' => $this->type,
        ]);
    }
}
