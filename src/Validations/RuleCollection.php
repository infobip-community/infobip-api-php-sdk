<?php

declare(strict_types=1);

namespace Infobip\Validations;

use Infobip\Validations\Rules\Rule;

final class RuleCollection
{
    /** @var array|Rule[] */
    private $rules = [];

    public function add(Rule $rule): self
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function addCollection(?RuleCollection $rules): self
    {
        if ($rules instanceof RuleCollection) {
            foreach ($rules->all() as $rule) {
                $this->add($rule);
            }
        }

        return $this;
    }

    public function all(): array
    {
        return $this->rules;
    }
}
