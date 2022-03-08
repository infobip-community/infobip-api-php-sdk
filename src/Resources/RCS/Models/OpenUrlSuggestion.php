<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\SuggestionType;

final class OpenUrlSuggestion implements ModelInterface, SuggestionInterface
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
            'type' => $this->type,
        ]);
    }
}
