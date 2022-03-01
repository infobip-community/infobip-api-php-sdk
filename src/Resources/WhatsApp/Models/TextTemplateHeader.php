<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\TemplateHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\TemplateHeaderType;

final class TextTemplateHeader implements TemplateHeaderInterface
{
    /** @var TemplateHeaderType */
    private $type;

    /** @var string */
    private $placeholder;

    public function __construct(string $placeholder)
    {
        $this->placeholder = $placeholder;
        $this->type = new TemplateHeaderType(TemplateHeaderType::TEXT);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'placeholder' => $this->placeholder,
        ]);
    }
}
