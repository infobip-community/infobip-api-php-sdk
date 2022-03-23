<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Collections\SuggestionCollection;
use Infobip\Resources\RCS\Contracts\MessageContentInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\MessageContentType;

final class TextMessageContent implements ModelInterface, MessageContentInterface
{
    /** @var MessageContentType */
    private $type;

    /** @var string */
    private $text;

    /** @var SuggestionCollection */
    private $suggestions;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->type = new MessageContentType(MessageContentType::TEXT);
        $this->suggestions = new SuggestionCollection();
    }

    public function addSuggestion(SuggestionInterface $suggestion): self
    {
        $this->suggestions->add($suggestion);

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'text' => $this->text,
            'suggestions' => $this->suggestions->toArray(),
        ]);
    }
}
