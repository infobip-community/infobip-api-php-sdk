<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\SMS\Models\Destination;
use Infobip\Resources\CollectionValidationInterface;
use Infobip\Validations\Rules;

final class DestinationCollection extends BaseCollection implements CollectionValidationInterface
{
    public function add(Destination $destination): self
    {
        $this->items[] = $destination;

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
