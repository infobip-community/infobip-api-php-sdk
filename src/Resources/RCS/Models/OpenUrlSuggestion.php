<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\SuggestionType;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;
use Infobip\Validations\Rules\UrlRule;

final class OpenUrlSuggestion implements SuggestionInterface
{
    /** @var SuggestionType */
    private $type;

    /** @var string */
    private $text;

    /** @var string */
    private $postbackData;

    /** @var string */
    private $url;

    public function __construct(
        string $text,
        string $postbackData,
        string $url
    ) {
        $this->text = $text;
        $this->postbackData = $postbackData;
        $this->url = $url;
        $this->type = new SuggestionType(SuggestionType::OPEN_URL);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'text' => $this->text,
            'postbackData' => $this->postbackData,
            'url' => $this->url,
            'type' => $this->type->getValue(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('openUrlSuggestion.text', $this->text, 1, 25))
            ->addRule(new BetweenLengthRule('openUrlSuggestion.postbackData', $this->postbackData, 1, 2048))
            ->addRule(new UrlRule('openUrlSuggestion.url', $this->url));
    }
}
