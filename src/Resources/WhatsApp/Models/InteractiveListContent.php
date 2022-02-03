<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class InteractiveListContent implements ModelInterface
{
    /** @var InteractiveListBody */
    private $body;

    /** @var InteractiveListAction */
    private $action;

    /** @var InteractiveListHeader|null */
    private $header;

    /** @var InteractiveListFooter|null  */
    private $footer;

    public function __construct(
        InteractiveListBody $body,
        InteractiveListAction $action
    ) {
        $this->body = $body;
        $this->action = $action;
    }

    public function setHeader(?InteractiveListHeader $header): self
    {
        $this->header = $header;
        return $this;
    }

    public function setFooter(?InteractiveListFooter $footer): self
    {
        $this->footer = $footer;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'body' => $this->body->toArray(),
            'action' => $this->action->toArray(),
            'header' => $this->header ? $this->header->toArray() : null,
            'footer' => $this->footer ? $this->footer->toArray() : null,
        ]);
    }
}
