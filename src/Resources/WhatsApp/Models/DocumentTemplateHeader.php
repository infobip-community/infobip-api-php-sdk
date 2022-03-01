<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\TemplateHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\TemplateHeaderType;

final class DocumentTemplateHeader implements TemplateHeaderInterface
{
    /** @var TemplateHeaderType */
    private $type;

    /** @var string */
    private $mediaUrl;

    /** @var string */
    private $filename;

    public function __construct(
        string $mediaUrl,
        string $filename
    ) {
        $this->mediaUrl = $mediaUrl;
        $this->filename = $filename;
        $this->type = new TemplateHeaderType(TemplateHeaderType::DOCUMENT);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'mediaUrl' => $this->mediaUrl,
            'filename' => $this->filename,
        ]);
    }
}
