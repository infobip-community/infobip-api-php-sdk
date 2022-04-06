<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Contracts\InteractiveButtonsHeaderInterface;
use Infobip\Validations\Rules;

final class InteractiveButtonsContent implements ModelInterface, ModelValidationInterface
{
    /** @var InteractiveButtonsBody */
    private $body;

    /** @var InteractiveButtonsAction */
    private $action;

    /** @var InteractiveButtonsHeaderInterface */
    private $header;

    /** @var InteractiveButtonsFooter */
    private $footer;

    public function __construct(
        InteractiveButtonsBody $body,
        InteractiveButtonsAction $action,
        InteractiveButtonsHeaderInterface $header,
        InteractiveButtonsFooter $footer
    ) {
        $this->body = $body;
        $this->action = $action;
        $this->header = $header;
        $this->footer = $footer;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'body' => $this->body->toArray(),
            'action' => $this->action->toArray(),
            'header' => $this->header->toArray(),
            'footer' => $this->footer->toArray(),
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
