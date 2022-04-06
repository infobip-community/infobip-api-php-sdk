<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\CollectionValidationInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Models\SectionRow;
use Infobip\Validations\Rules;

final class SectionRowCollection extends BaseCollection implements CollectionValidationInterface
{
    public function add(SectionRow $sectionRow): self
    {
        $this->items[] = $sectionRow;

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
