<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class InteractiveMultiProductHeader implements ModelInterface
{
    /** @var string */
    private $text;

    /** @var string */
    private $type;

    public function __construct(
        string $text,
        string $type
    ) {
        $this->text = $text;
        $this->type = $type;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'type' => $this->type,
        ]);
    }
}
