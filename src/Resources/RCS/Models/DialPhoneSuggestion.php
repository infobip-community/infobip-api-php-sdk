<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\SuggestionType;

final class DialPhoneSuggestion implements ModelInterface, SuggestionInterface
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
            'type' => $this->type,
        ]);
    }
}
