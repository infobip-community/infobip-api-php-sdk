<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\InteractiveButtonsInterface;
use Infobip\Resources\WhatsApp\Enums\InteractiveButtonType;

final class ReplyInteractiveButtons implements InteractiveButtonsInterface
{
    /** @var string */
    private $id;

    /** @var InteractiveButtonType */
    private $type;

    /** @var string */
    private $title;

    public function __construct(
        string $id,
        string $title
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->type = new InteractiveButtonType(InteractiveButtonType::REPLY);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'id' => $this->id,
            'title' => $this->title,
        ]);
    }
}
