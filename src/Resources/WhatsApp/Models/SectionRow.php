<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\ModelValidationInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;

final class SectionRow implements ModelInterface, ModelValidationInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $title;

    /** @var string|null */
    private $description;

    public function __construct(
        string $id,
        string $title,
        string $description
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new BetweenLengthRule('sectionRow.id', $this->id, 1, 200))
            ->addRule(new BetweenLengthRule('sectionRow.title', $this->title, 1, 24))
            ->addRule(new BetweenLengthRule('sectionRow.description', $this->description, 0, 72));
    }
}
