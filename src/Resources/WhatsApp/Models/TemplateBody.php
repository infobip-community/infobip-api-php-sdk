<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Collections\PlaceholderCollection;

final class TemplateBody implements ModelInterface
{
    /** @var PlaceholderCollection */
    private $placeholders;

    public function __construct()
    {
        $this->placeholders = new PlaceholderCollection();
    }

    public function addPlaceholder(string $placeholder): self
    {
        $this->placeholders->add($placeholder);
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'placeholders' => $this->placeholders->toArray(),
        ]);
    }
}
