<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\WhatsApp\Contracts\InteractiveMultiProductHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\InteractiveMultiProductHeaderType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

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

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('interactiveMultiProductTextHeader.text', $this->text, 1, 60));
    }
}
