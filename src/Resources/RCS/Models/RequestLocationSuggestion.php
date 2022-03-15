<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\SuggestionType;

final class RequestLocationSuggestion implements ModelInterface, SuggestionInterface
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
        $this->type = new SuggestionType(SuggestionType::REQUEST_LOCATION);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'postbackData' => $this->postbackData,
            'type' => $this->type,
        ]);
    }
}