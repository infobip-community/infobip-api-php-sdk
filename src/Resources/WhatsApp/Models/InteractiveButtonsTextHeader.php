<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\InteractiveButtonsHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\InteractiveButtonHeaderType;

final class InteractiveButtonsTextHeader implements InteractiveButtonsHeaderInterface
{
    /** @var InteractiveButtonHeaderType */
    private $type;

    /** @var string */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->type = new InteractiveButtonHeaderType(InteractiveButtonHeaderType::TEXT);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'text' => $this->text,
        ]);
    }
}
