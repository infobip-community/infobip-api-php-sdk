<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Enums\EmailType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\EmailRule;

final class Email implements ModelInterface, ModelValidationInterface
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

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new EmailRule('email.email', $this->email));
    }
}
