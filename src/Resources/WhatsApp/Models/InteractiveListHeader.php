<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class InteractiveListHeader implements ModelInterface
{
    /** @var string */
    private $type;

    /** @var string */
    private $text;

    public function __construct(
        string $type,
        string $text
    ) {
        $this->type = $type;
        $this->text = $text;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'type' => $this->type,
        ]);
    }
}
