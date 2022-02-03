<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class TemplateData implements ModelInterface
{
    /** @var TemplateBody */
    private $body;

    public function __construct(
        TemplateBody $body
    ) {
        $this->body = $body;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'body' => $this->body,
        ]);
    }
}
