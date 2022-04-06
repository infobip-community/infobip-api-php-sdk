<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\CollectionValidationInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Contracts\TemplateButtonInterface;
use Infobip\Validations\Rules;

final class TemplateButtonCollection extends BaseCollection implements CollectionValidationInterface
{
    public function add(TemplateButtonInterface $templateButton): self
    {
        $this->items[] = $templateButton;

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
