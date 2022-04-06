<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Contracts\InteractiveMultiProductHeaderInterface;
use Infobip\Validations\Rules;

final class InteractiveMultiProductContent implements ModelInterface, ModelValidationInterface
{
    /** @var InteractiveMultiProductBody */
    private $body;

    /** @var InteractiveMultiProductAction */
    private $action;

    /** @var InteractiveMultiProductHeaderInterface */
    private $header;

    /** @var InteractiveMultiProductFooter|null */
    private $footer;

    public function __construct(
        InteractiveMultiProductBody $body,
        InteractiveMultiProductAction $action,
        InteractiveMultiProductHeaderInterface $header
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

    public function rules(): Rules
    {
        return (new Rules())
            ->addModelRules($this->body)
            ->addModelRules($this->action)
            ->addModelRules($this->header)
            ->addModelRules($this->footer);
    }
}
