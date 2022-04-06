<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Collections\TemplateButtonCollection;
use Infobip\Resources\WhatsApp\Contracts\TemplateButtonInterface;
use Infobip\Resources\WhatsApp\Contracts\TemplateHeaderInterface;
use Infobip\Validations\Rules;

final class TemplateData implements ModelInterface, ModelValidationInterface
{
    /** @var TemplateBody */
    private $body;

    /** @var TemplateHeaderInterface|null */
    private $templateHeader = null;

    /** @var TemplateButtonCollection */
    private $templateButtons;

    public function __construct(
        TemplateBody $body
    ) {
        $this->body = $body;
        $this->templateButtons = new TemplateButtonCollection();
    }

    public function setTemplateHeader(?TemplateHeaderInterface $templateHeader): self
    {
        $this->templateHeader = $templateHeader;
        return $this;
    }

    public function addTemplateButton(TemplateButtonInterface $templateButton): self
    {
        $this->templateButtons->add($templateButton);
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'body' => $this->body,
            'header' => $this->templateHeader ? $this->templateHeader->toArray() : null,
            'buttons' => $this->templateButtons->toArray(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addCollectionRules($this->templateButtons);
    }
}
