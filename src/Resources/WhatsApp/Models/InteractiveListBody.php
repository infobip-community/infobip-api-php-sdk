<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

final class InteractiveListBody implements ModelInterface, ModelValidationInterface
{
    /** @var string */
    private $text;

    public function __construct(
        string $text
    ) {
        $this->text = $text;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('interactiveListBody.text', $this->text, 1, 1024));
    }
}
