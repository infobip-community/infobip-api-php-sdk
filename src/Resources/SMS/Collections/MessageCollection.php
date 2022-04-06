<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\CollectionValidationInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\SMS\Models\Message;
use Infobip\Validations\Rules;

final class MessageCollection extends BaseCollection implements CollectionValidationInterface
{
    public function add(Message $message): self
    {
        $this->items[] = $message;

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
