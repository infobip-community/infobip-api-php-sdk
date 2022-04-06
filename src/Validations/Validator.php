<?php

declare(strict_types=1);

namespace Infobip\Validations;

use Infobip\Exceptions\InfobipValidationException;
use Infobip\Resources\ResourceValidationInterface;
use ReflectionClass;

final class Validator
{
    /** @var Rules */
    private $rules;

    /** @var array|string[] */
    private $errors = [];

    /**
     * @throws InfobipValidationException
     */
    public static function validateResource(ResourceValidationInterface $resource): void
    {
        $self = new self($resource->rules());

        $self->validate();

        if ($self->hasErrors()) {
            throw InfobipValidationException::create(
                sprintf('Resource "%s" is not valid', $self->getResourceName($resource)),
                $self->errors
            );
        }
    }

    private function validate(): void
    {
        foreach ($this->rules->getRules() as $rule) {
            if (false === $rule->passes()) {
                $this->addError($rule->attribute(), $rule->message());
            }
        }
    }

    private function hasErrors(): bool
    {
        if (empty($this->errors)) {
            return false;
        }

        return true;
    }

    private function addError(string $attribute, string $error): void
    {
        if (false === isset($this->errors[$attribute])) {
            $this->errors[$attribute] = $error;
        }
    }

    private function getResourceName(ResourceValidationInterface $resource): string
    {
        return (new ReflectionClass($resource))
            ->getShortName();
    }

    private function __construct(Rules $rules)
    {
        $this->rules = $rules;
    }
}
