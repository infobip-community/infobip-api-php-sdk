<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Collections\InteractiveButtonCollection;
use Infobip\Validations\Rules;

final class InteractiveButtonsAction implements ModelInterface, ModelValidationInterface
{
    /** @var InteractiveButtonCollection */
    private $interactiveButtons;

    public function __construct()
    {
        $this->interactiveButtons = new InteractiveButtonCollection();
    }

    public function addInteractiveButton(ReplyInteractiveButtons $interactiveButton): self
    {
        $this->interactiveButtons->add($interactiveButton);
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'buttons' => $this->interactiveButtons->toArray(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addCollectionRules($this->interactiveButtons);
    }
}
