<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Collections\InteractiveButtonCollection;

final class InteractiveButtonsAction implements ModelInterface
{
    /** @var InteractiveButtonCollection */
    private $interactiveButtons;

    public function __construct()
    {
        $this->interactiveButtons = new InteractiveButtonCollection();
    }

    public function addInteractiveButton(InteractiveButton $interactiveButton): self
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
}
