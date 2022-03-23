<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\SuggestionType;

final class ShowLocationSuggestion implements ModelInterface, SuggestionInterface
{
    /** @var SuggestionType */
    private $type;

    /** @var string */
    private $text;

    /** @var string */
    private $postbackData;

    /** @var int */
    private $latitude;

    /** @var int */
    private $longitude;

    /** @var string|null */
    private $label = null;

    public function __construct(
        string $text,
        string $postbackData,
        int $latitude,
        int $longitude
    ) {
        $this->text = $text;
        $this->postbackData = $postbackData;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->type = new SuggestionType(SuggestionType::SHOW_LOCATION);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'postbackData' => $this->postbackData,
            'type' => $this->type->getValue(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'label' => $this->label,
        ]);
    }
}
