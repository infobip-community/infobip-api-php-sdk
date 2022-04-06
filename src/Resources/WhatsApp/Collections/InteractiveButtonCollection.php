<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\CollectionValidationInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Contracts\InteractiveButtonsInterface;
use Infobip\Validations\Rules;

final class InteractiveButtonCollection extends BaseCollection implements CollectionValidationInterface
{
    public function add(InteractiveButtonsInterface $interactiveButton): self
    {
        $this->items[] = $interactiveButton;

        return $this;
    }

    public function rules(): Rules
    {
        $rules = new Rules();

        /** @var ModelValidationInterface $item */
        foreach ($this->items as $item) {
            $rules->addModelRules($item);
        }

        return $rules;
    }
}
