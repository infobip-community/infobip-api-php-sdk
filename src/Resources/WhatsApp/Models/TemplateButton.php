<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class TemplateButton implements ModelInterface
{
    /** @var string */
    private $type;

    /** @var string */
    private $parameter;

    public function __construct(
        string $type,
        string $parameter
    ) {
        $this->type = $type;
        $this->parameter = $parameter;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type,
            'parameter' => $this->parameter,
        ]);
    }
}
