<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class Url implements ModelInterface
{
    /** @var string|null */
    private $url = null;

    /** @var string|null */
    private $type = null;

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'url' => $this->url,
            'type' => $this->type,
        ]);
    }
}
