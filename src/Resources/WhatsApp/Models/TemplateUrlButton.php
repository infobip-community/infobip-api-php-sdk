<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\TemplateButtonInterface;
use Infobip\Resources\WhatsApp\Enums\TemplateButtonType;

final class TemplateUrlButton implements TemplateButtonInterface
{
    /** @var TemplateButtonType */
    private $type;

    /** @var string */
    private $parameter;

    public function __construct(string $parameter)
    {
        $this->parameter = $parameter;
        $this->type = new TemplateButtonType(TemplateButtonType::URL);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'parameter' => $this->parameter,
        ]);
    }
}
