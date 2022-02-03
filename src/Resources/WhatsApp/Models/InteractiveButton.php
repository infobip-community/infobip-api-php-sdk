<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class InteractiveButton implements ModelInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $type;

    /** @var string */
    private $title;

    public function __construct(
        string $id,
        string $type,
        string $title
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type,
            'id' => $this->id,
            'title' => $this->title,
        ]);
    }
}
