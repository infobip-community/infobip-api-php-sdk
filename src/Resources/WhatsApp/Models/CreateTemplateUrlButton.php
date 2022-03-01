<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\CreateTemplateButtonInterface;
use Infobip\Resources\WhatsApp\Enums\CreateTemplateButtonType;

final class CreateTemplateUrlButton implements CreateTemplateButtonInterface
{
    /** @var CreateTemplateButtonType */
    private $type;

    /** @var string */
    private $text;

    /** @var string */
    private $url;

    public function __construct(
        string $text,
        string $url
    ) {
        $this->text = $text;
        $this->url = $url;
        $this->type = new CreateTemplateButtonType(CreateTemplateButtonType::URL);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'text' => $this->text,
            'url' => $this->url,
        ]);
    }
}
