<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class TemplateName implements ModelInterface
{
    /** @var string */
    private $templateName;

    public function __construct(
        string $templateName
    ) {
        $this->templateName = $templateName;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'templateName' => $this->templateName,
        ]);
    }
}
