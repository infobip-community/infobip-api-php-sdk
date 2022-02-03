<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class TemplateHeader implements ModelInterface
{
    /** @var string */
    private $type;

    /** @var string */
    private $placeholder;

    public function __construct(
        string $type,
        string $placeholder
    ) {
        $this->type = $type;
        $this->placeholder = $placeholder;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type,
            'placeholder' => $this->placeholder,
        ]);
    }
}
