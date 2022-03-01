<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\InteractiveMultiProductHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\InteractiveMultiProductHeaderType;

final class InteractiveMultiProductTextHeader implements InteractiveMultiProductHeaderInterface
{
    /** @var string */
    private $text;

    /** @var InteractiveMultiProductHeaderType */
    private $type;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->type = new InteractiveMultiProductHeaderType(InteractiveMultiProductHeaderType::TEXT);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'type' => $this->type->getValue(),
        ]);
    }
}
