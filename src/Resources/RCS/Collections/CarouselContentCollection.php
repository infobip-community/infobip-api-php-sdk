<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\CollectionValidationInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\RCS\Models\CarouselContent;
use Infobip\Validations\Rules;

final class CarouselContentCollection extends BaseCollection implements CollectionValidationInterface
{
    /** @var array|CarouselContent[] */
    protected $items = [];

    public function add(CarouselContent $item): self
    {
        $this->items[] = $item;

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
