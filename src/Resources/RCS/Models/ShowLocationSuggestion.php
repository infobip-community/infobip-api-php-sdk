<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\SuggestionType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\LatitudeRule;
use Infobip\Validations\Rules\LongitudeRule;
use Infobip\Validations\Rules\BetweenLengthRule;

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

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('showLocationSuggestion.text', $this->text, 1, 25))
            ->addRule(new BetweenLengthRule('showLocationSuggestion.postbackData', $this->postbackData, 1, 2048))
            ->addRule(new LatitudeRule('showLocationSuggestion.latitude', $this->latitude))
            ->addRule(new LongitudeRule('showLocationSuggestion.longitude', $this->longitude))
            ->addRule(new BetweenLengthRule('showLocationSuggestion.label', $this->postbackData, 1, 100));
    }
}
