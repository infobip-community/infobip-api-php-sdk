<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\RCS\Collections\SuggestionCollection;
use Infobip\Resources\RCS\Contracts\SuggestionInterface;

final class CardContent implements ModelInterface
{
    /** @var string|null */
    private $title = null;

    /** @var string|null */
    private $description = null;

    /** @var Media|null */
    private $media = null;

    /** @var SuggestionCollection */
    private $suggestions;

    public function __construct()
    {
        $this->suggestions = new SuggestionCollection();
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setMedia(?Media $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function addSuggestion(SuggestionInterface $suggestion): self
    {
        $this->suggestions->add($suggestion);

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->media ? $this->media->toArray() : null,
            'suggestions' => $this->suggestions->toArray(),
        ]);
    }
}
