<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;

final class Placeholders implements ModelInterface
{
    /** @var array */
    private $placeholders;

    public function __construct(array $placeholders)
    {
        $this->placeholders = $placeholders;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'placeholders' => $this->placeholders
        ]);
    }
}
