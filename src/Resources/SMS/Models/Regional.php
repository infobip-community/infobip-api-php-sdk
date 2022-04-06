<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;

final class Regional implements ModelInterface
{
    /** @var string */
    private $principalEntityId;

    /** @var string|null */
    private $contentTemplateId;

    public function __construct(string $principalEntityId)
    {
        $this->principalEntityId = $principalEntityId;
    }

    public function setContentTemplateId(?string $contentTemplateId): self
    {
        $this->contentTemplateId = $contentTemplateId;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'indiaDlt' => [
                'contentTemplateId' => $this->contentTemplateId,
                'principalEntityId' => $this->principalEntityId,
            ]
        ]);
    }
}
