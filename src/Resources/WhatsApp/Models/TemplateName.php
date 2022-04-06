<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

final class TemplateName implements ModelInterface, ModelValidationInterface
{
    /** @var string */
    private $templateName;

    public function __construct(
        string $templateName
    ) {
        $this->templateName = $templateName;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'templateName' => $this->templateName,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('templateName.name', $this->templateName, 1, 512));
    }
}
