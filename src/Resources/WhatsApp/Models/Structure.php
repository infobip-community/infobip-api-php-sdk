<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Collections\CreateTemplateButtonCollection;
use Infobip\Resources\WhatsApp\Contracts\CreateTemplateButtonInterface;
use Infobip\Resources\WhatsApp\Contracts\CreateTemplateHeaderInterface;

final class Structure implements ModelInterface
{
    /** @var string */
    private $body;

    /** @var CreateTemplateHeaderInterface|null */
    private $header = null;

    /** @var string|null */
    private $footer = null;

    /** @var CreateTemplateButtonCollection */
    private $buttons;

    public function __construct(string $body)
    {
        $this->body = $body;
        $this->buttons = new CreateTemplateButtonCollection();
    }

    public function setHeader(?CreateTemplateHeaderInterface $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function setFooter(?string $footer): self
    {
        $this->footer = $footer;

        return $this;
    }

    public function addButton(CreateTemplateButtonInterface $button): self
    {
        $this->buttons->add($button);

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'header' => $this->header,
            'body' => $this->body,
            'footer' => $this->footer,
            'buttons' => $this->buttons,
        ]);
    }
}
