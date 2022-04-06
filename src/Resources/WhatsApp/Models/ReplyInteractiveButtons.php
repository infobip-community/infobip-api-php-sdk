<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\InteractiveButtonsInterface;
use Infobip\Resources\WhatsApp\Enums\InteractiveButtonType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

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

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('replyInteractiveButtons.id', $this->id, 1, 256))
            ->addRule(new BetweenLengthRule('replyInteractiveButtons.title', $this->title, 1, 20));
    }
}
