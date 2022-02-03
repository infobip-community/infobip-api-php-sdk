<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class InteractiveMultiProductContent implements ModelInterface
{
    /** @var InteractiveMultiProductBody */
    private $body;

    /** @var InteractiveMultiProductAction */
    private $action;

    /** @var InteractiveMultiProductHeader */
    private $header;

    /** @var InteractiveMultiProductFooter|null */
    private $footer;

    public function __construct(
        InteractiveMultiProductBody $body,
        InteractiveMultiProductAction $action,
        InteractiveMultiProductHeader $header
    ) {
        $this->body = $body;
        $this->action = $action;
        $this->header = $header;
    }

    public function setFooter(?InteractiveMultiProductFooter $footer): self
    {
        $this->footer = $footer;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'body' => $this->body->toArray(),
            'action' => $this->action->toArray(),
            'header' => $this->header->toArray(),
            'footer' => $this->footer ? $this->footer->toArray() : null,
        ]);
    }
}
