<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\RCS\Collections\CarouselContentCollection;
use Infobip\Resources\RCS\Collections\SuggestionCollection;
use Infobip\Resources\RCS\Contracts\MessageContentInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\CardWidth;
use Infobip\Resources\RCS\Enums\MessageContentType;
use Infobip\Validations\Rules;

final class CarouselMessageContent implements MessageContentInterface
{
    /** @var MessageContentType */
    private $type;

    /** @var CardWidth */
    private $cardWidth;

    /** @var CarouselContentCollection */
    private $contents;

    /** @var SuggestionCollection */
    private $suggestions;

    public function __construct(
        CardWidth $cardWidth
    ) {
        $this->cardWidth = $cardWidth;
        $this->type = new MessageContentType(MessageContentType::CAROUSEL);
        $this->contents = new CarouselContentCollection();
        $this->suggestions = new SuggestionCollection();
    }

    public function addSuggestion(SuggestionInterface $suggestion): self
    {
        $this->suggestions->add($suggestion);

        return $this;
    }

    public function addCarouselContent(CarouselContent $carouselContent): self
    {
        $this->contents->add($carouselContent);

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'cardWidth' => $this->cardWidth->getValue(),
            'contents' => $this->contents->toArray(),
            'suggestions' => $this->suggestions->toArray(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addCollectionRules($this->contents)
            ->addCollectionRules($this->suggestions);
    }
}
