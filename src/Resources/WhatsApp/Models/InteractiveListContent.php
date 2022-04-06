<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Contracts\InteractiveListHeaderInterface;
use Infobip\Validations\Rules;

final class InteractiveListContent implements ModelInterface, ModelValidationInterface
{
    /** @var InteractiveListBody */
    private $body;

    /** @var InteractiveListAction */
    private $action;

    /** @var InteractiveListHeaderInterface|null */
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

    public function setHeader(?InteractiveListHeaderInterface $header): self
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

    public function rules(): Rules
    {
        return (new Rules())
            ->addModelRules($this->body)
            ->addModelRules($this->action)
            ->addModelRules($this->header)
            ->addModelRules($this->footer);
    }
}
