<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class InteractiveProductContent implements ModelInterface
{
    /** @var InteractiveProductBody */
    private $body;

    /** @var InteractiveProductAction */
    private $action;

    /** @var InteractiveProductFooter|null */
    private $footer;

    public function __construct(
        InteractiveProductBody $body,
        InteractiveProductAction $action
    ) {
        $this->body = $body;
        $this->action = $action;
    }

    public function setFooter(?InteractiveProductFooter $footer): self
    {
        $this->footer = $footer;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'body' => $this->body->toArray(),
            'action' => $this->action->toArray(),
            'footer' => $this->footer ? $this->footer->toArray() : null,
        ]);
    }
}
