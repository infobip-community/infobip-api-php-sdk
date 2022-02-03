<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Collections\SectionRowCollection;

final class Section implements ModelInterface
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
}
