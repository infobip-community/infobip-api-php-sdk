<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\RCS\Collections\SuggestionCollection;
use Infobip\Resources\RCS\Contracts\MessageContentInterface;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;
use Infobip\Resources\RCS\Enums\Alignment;
use Infobip\Resources\RCS\Enums\MessageContentType;
use Infobip\Resources\RCS\Enums\Orientation;
use Infobip\Validations\Rules;

final class CardMessageContent implements MessageContentInterface
{
    /** @var MessageContentType */
    private $type;

    /** @var Orientation */
    private $orientation;

    /** @var Alignment */
    private $alignment;

    /** @var CardContent */
    private $content;

    /** @var SuggestionCollection */
    private $suggestions;

    public function __construct(
        Orientation $orientation,
        Alignment $alignment,
        CardContent $content
    ) {
        $this->orientation = $orientation;
        $this->alignment = $alignment;
        $this->content = $content;
        $this->type = new MessageContentType(MessageContentType::CARD);
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
            'orientation' => $this->orientation->getValue(),
            'alignment' => $this->alignment->getValue(),
            'content' => $this->content->toArray(),
            'suggestions' => $this->suggestions->toArray(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addCollectionRules($this->suggestions);
    }
}
