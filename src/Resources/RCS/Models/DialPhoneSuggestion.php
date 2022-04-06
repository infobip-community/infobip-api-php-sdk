<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\SuggestionType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

final class DialPhoneSuggestion implements SuggestionInterface
{
    /** @var SuggestionType */
    private $type;

    /** @var string */
    private $text;

    /** @var string */
    private $postbackData;

    /** @var string */
    private $phoneNumber;

    public function __construct(
        string $text,
        string $postbackData,
        string $phoneNumber
    ) {
        $this->text = $text;
        $this->postbackData = $postbackData;
        $this->phoneNumber = $phoneNumber;
        $this->type = new SuggestionType(SuggestionType::DIAL_PHONE);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'postbackData' => $this->postbackData,
            'phoneNumber' => $this->phoneNumber,
            'type' => $this->type->getValue(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('dialPhoneSuggestion.text', $this->text, 1, 25))
            ->addRule(new BetweenLengthRule('dialPhoneSuggestion.postbackData', $this->postbackData, 1, 2048));
    }
}
