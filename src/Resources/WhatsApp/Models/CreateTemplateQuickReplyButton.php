<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\CreateTemplateButtonInterface;
use Infobip\Resources\WhatsApp\Enums\CreateTemplateButtonType;

final class CreateTemplateQuickReplyButton implements CreateTemplateButtonInterface
{
    /** @var CreateTemplateButtonType */
    private $type;

    /** @var string */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->type = new CreateTemplateButtonType(CreateTemplateButtonType::QUICK_REPLY);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'text' => $this->text,
        ]);
    }
}
