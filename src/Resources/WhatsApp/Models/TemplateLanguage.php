<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class TemplateLanguage implements ModelInterface
{
    /** @var string */
    private $language;

    public function __construct(
        string $language
    ) {
        $this->language = $language;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'language' => $this->language,
        ]);
    }
}
