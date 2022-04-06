<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\SuggestionType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

final class ReplySuggestion implements SuggestionInterface
{
    /** @var SuggestionType */
    private $type;

    /** @var string */
    private $text;

    /** @var string */
    private $postbackData;

    public function __construct(
        string $text,
        string $postbackData
    ) {
        $this->text = $text;
        $this->postbackData = $postbackData;
        $this->type = new SuggestionType(SuggestionType::REPLY);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'postbackData' => $this->postbackData,
            'type' => $this->type->getValue(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('replySuggestion.text', $this->text, 1, 25))
            ->addRule(new BetweenLengthRule('replySuggestion.postbackData', $this->postbackData, 1, 2048));
    }
}
