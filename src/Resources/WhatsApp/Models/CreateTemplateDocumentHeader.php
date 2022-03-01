<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\CreateTemplateHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\TemplateHeaderType;

final class CreateTemplateDocumentHeader implements CreateTemplateHeaderInterface
{
    /** @var TemplateHeaderType */
    private $format;

    public function __construct()
    {
        $this->format = new TemplateHeaderType(TemplateHeaderType::DOCUMENT);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'format' => $this->format->getValue(),
        ]);
    }
}
