<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class SectionRow implements ModelInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $title;

    /** @var string|null */
    private $description;

    public function __construct(
        string $id,
        string $title,
        string $description
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
