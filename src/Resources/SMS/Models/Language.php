<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;

final class Language implements ModelInterface
{
    /** @var string|null */
    private $languageCode;

    public function setLanguageCode(?string $languageCode): self
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'languageCode' => $this->languageCode,
        ]);
    }
}
