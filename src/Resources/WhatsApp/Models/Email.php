<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Enums\EmailType;

final class Email implements ModelInterface
{
    /** @var string */
    private $email;

    /** @var EmailType */
    private $type;

    public function __construct(string $email, EmailType $type)
    {
        $this->email = $email;
        $this->type = $type;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'email' => $this->email,
            'type' => $this->type->getValue(),
        ]);
    }
}
