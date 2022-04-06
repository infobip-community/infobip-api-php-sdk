<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Collections\SectionCollection;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

final class InteractiveListAction implements ModelInterface, ModelValidationInterface
{
    /** @var string */
    private $title;

    /** @var SectionCollection */
    private $sections;

    public function __construct(
        string $title
    ) {
        $this->title = $title;
        $this->sections = new SectionCollection();
    }

    public function addSection(Section $section): self
    {
        $this->sections->add($section);
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'title' => $this->title,
            'sections' => $this->sections->toArray(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('interactiveListAction.title', $this->title, 1, 20))
            ->addCollectionRules($this->sections);
    }
}
