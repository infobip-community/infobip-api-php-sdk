<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\TemplateHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\TemplateHeaderType;

final class ImageTemplateHeader implements TemplateHeaderInterface
{
    /** @var TemplateHeaderType */
    private $type;

    /** @var string */
    private $mediaUrl;

    public function __construct(string $mediaUrl)
    {
        $this->type = new TemplateHeaderType(TemplateHeaderType::IMAGE);
        $this->mediaUrl = $mediaUrl;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'mediaUrl' => $this->mediaUrl,
        ]);
    }
}
