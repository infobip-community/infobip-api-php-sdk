<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class TextContent implements ModelInterface
{
    /** @var string */
    private $text;

    /** @var string|null */
    private $previewUrl = null;

    public function __construct(
        string $text
    ) {
        $this->text = $text;
    }

    public function setPreviewUrl(?string $previewUrl): self
    {
        $this->previewUrl = $previewUrl;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'previewUrl' => $this->previewUrl,
        ]);
    }
}
