<?php

declare(strict_types=1);

namespace Infobip\Validations;

use Infobip\Resources\CollectionValidationInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules\Rule;

final class Rules
{
    /** @var array|Rule[] */
    private $rules = [];

    public function addRule(Rule $rule): self
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function addModelRules(?ModelValidationInterface $model): self
    {
        if ($model instanceof ModelValidationInterface) {
            $this->addRules($model->rules());
        }

        return $this;
    }

    public function addCollectionRules(?CollectionValidationInterface $collection): self
    {
        if ($collection instanceof CollectionValidationInterface) {
            $this->addRules($collection->rules());
        }

        return $this;
    }

    public function addRules(?Rules $rules): self
    {
        if ($rules instanceof Rules) {
            foreach ($rules->getRules() as $rule) {
                $this->addRule($rule);
            }
        }

        return $this;
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}
