<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules;

final class TemplateContent implements ModelInterface, ModelValidationInterface
{
    /** @var TemplateName */
    private $templateName;

    /** @var TemplateData */
    private $templateData;

    /** @var TemplateLanguage */
    private $templateLanguage;

    public function __construct(
        TemplateName $templateName,
        TemplateData $templateData,
        TemplateLanguage $templateLanguage
    ) {
        $this->templateName = $templateName;
        $this->templateData = $templateData;
        $this->templateLanguage = $templateLanguage;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'templateName' => $this->templateName->toArray(),
            'templateData' => $this->templateData->toArray(),
            'templateLanguage' => $this->templateLanguage->toArray(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addModelRules($this->templateName)
            ->addModelRules($this->templateData);
    }
}
