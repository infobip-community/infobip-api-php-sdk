<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Resources\WhatsApp\Collections\InteractiveMultiProductSectionCollection;
use Infobip\Validations\Rules;

final class InteractiveMultiProductAction implements ModelInterface, ModelValidationInterface
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

    public function rules(): Rules
    {
        return (new Rules())
            ->addCollectionRules($this->sections);
    }
}
