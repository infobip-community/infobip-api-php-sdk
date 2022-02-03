<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class DocumentContent implements ModelInterface
{
    /** @var string */
    private $mediaUrl;

    /** @var string|null */
    private $caption = null;

    /** @var string|null */
    private $filename = null;

    public function __construct(
        string $mediaUrl
    ) {
        $this->mediaUrl = $mediaUrl;
    }

    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;
        return $this;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'mediaUrl' => $this->mediaUrl,
            'caption' => $this->caption,
            'filename' => $this->filename,
        ]);
    }
}
