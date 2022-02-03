<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class InteractiveMultiProductBody implements ModelInterface
{
    /** @var string */
    private $text;

    public function __construct(
        string $text
    ) {
        $this->text = $text;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
        ]);
    }
}
