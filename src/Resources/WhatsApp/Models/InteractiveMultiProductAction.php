<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Collections\InteractiveMultiProductSectionCollection;

final class InteractiveMultiProductAction implements ModelInterface
{
    /** @var string */
    private $catalogId;

    /** @var InteractiveMultiProductSectionCollection */
    private $sections;

    public function __construct(
        string $catalogId
    ) {
        $this->catalogId = $catalogId;
        $this->sections = new InteractiveMultiProductSectionCollection();
    }

    public function addInteractiveMultiProductSection(InteractiveMultiProductSection $section): self
    {
        $this->sections->add($section);
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'catalogId' => $this->catalogId,
            'sections' => $this->sections->toArray(),
        ]);
    }
}
