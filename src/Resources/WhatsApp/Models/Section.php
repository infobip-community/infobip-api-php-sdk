<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Collections\SectionRowCollection;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

final class Section implements ModelInterface, ModelValidationInterface
{
    /** @var string|null */
    private $title;

    /** @var SectionRowCollection */
    private $rows;

    public function __construct()
    {
        $this->rows = new SectionRowCollection();
    }

    public function addSectionRow(SectionRow $sectionRow): self
    {
        $this->rows->add($sectionRow);
        return $this;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'title' => $this->title,
            'rows' => $this->rows->toArray(),
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('section.title', $this->title, 1, 24))
            ->addCollectionRules($this->rows);
    }
}
