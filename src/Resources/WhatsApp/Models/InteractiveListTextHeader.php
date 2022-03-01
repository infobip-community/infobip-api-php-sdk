<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\InteractiveListHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\InteractiveListHeaderType;

final class InteractiveListTextHeader implements InteractiveListHeaderInterface
{
    /** @var InteractiveListHeaderType */
    private $type;

    /** @var string */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->type = new InteractiveListHeaderType(InteractiveListHeaderType::TEXT);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'type' => $this->type->getValue(),
        ]);
    }
}
