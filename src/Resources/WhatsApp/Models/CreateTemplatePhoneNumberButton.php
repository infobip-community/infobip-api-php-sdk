<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\CreateTemplateButtonInterface;
use Infobip\Resources\WhatsApp\Enums\CreateTemplateButtonType;

final class CreateTemplatePhoneNumberButton implements CreateTemplateButtonInterface
{
    /** @var CreateTemplateButtonType */
    private $type;

    /** @var string */
    private $text;

    /** @var string */
    private $phoneNumber;

    public function __construct(
        string $text,
        string $phoneNumber
    ) {
        $this->text = $text;
        $this->phoneNumber = $phoneNumber;
        $this->type = new CreateTemplateButtonType(CreateTemplateButtonType::PHONE_NUMBER);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'text' => $this->text,
            'phoneNumber' => $this->phoneNumber,
        ]);
    }
}
