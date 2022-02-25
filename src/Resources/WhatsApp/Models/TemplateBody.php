<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Collections\PlaceholderCollection;
use Infobip\Resources\WhatsApp\Collections\TemplateButtonCollection;
use Infobip\Resources\WhatsApp\Contracts\TemplateButtonInterface;

final class TemplateBody implements ModelInterface
{
    /** @var PlaceholderCollection */
    private $placeholders;

    /** @var TemplateHeader|null */
    private $templateHeader = null;

    /** @var TemplateButtonCollection */
    private $templateButtons;

    public function __construct()
    {
        $this->placeholders = new PlaceholderCollection();
        $this->templateButtons = new TemplateButtonCollection();
    }

    public function addPlaceholder(string $placeholder): self
    {
        $this->placeholders->add($placeholder);
        return $this;
    }

    public function addTemplateButton(TemplateButtonInterface $templateButton): self
    {
        $this->templateButtons->add($templateButton);
        return $this;
    }

    public function setTemplateHeader(?TemplateHeader $templateHeader): self
    {
        $this->templateHeader = $templateHeader;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'placeholders' => $this->placeholders->toArray(),
            'header' => $this->templateHeader ? $this->templateHeader->toArray() : null,
            'buttons' => $this->templateButtons->toArray(),
        ]);
    }
}
