<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\CreateTemplateHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\TemplateHeaderType;

final class CreateTemplateTextHeader implements CreateTemplateHeaderInterface
{
    /** @var TemplateHeaderType */
    private $format;

    /** @var string */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->format = new TemplateHeaderType(TemplateHeaderType::TEXT);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'format' => $this->format->getValue(),
            'text' => $this->text,
        ]);
    }
}
