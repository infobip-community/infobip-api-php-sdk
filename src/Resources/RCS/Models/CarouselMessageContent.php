<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Collections\SuggestionCollection;
use Infobip\Resources\RCS\Contracts\MessageContentInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\CardWidth;
use Infobip\Resources\RCS\Enums\MessageContentType;

final class CarouselMessageContent implements ModelInterface, MessageContentInterface
{
    /** @var MessageContentType */
    private $type;

    /** @var CardWidth */
    private $cardWidth;

    /** @var CarouselContent */
    private $content;

    /** @var SuggestionCollection */
    private $suggestions;

    public function __construct(
        CardWidth $cardWidth,
        CarouselContent $content
    ) {
        $this->cardWidth = $cardWidth;
        $this->content = $content;
        $this->type = new MessageContentType(MessageContentType::CAROUSEL);
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
            'cardWidth' => $this->cardWidth->getValue(),
            'content' => $this->content->toArray(),
            'suggestions' => $this->suggestions->toArray(),
        ]);
    }
}
