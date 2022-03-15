<?php

declare(strict_types=1);

namespace Infobip\Resources\RCS\Models;

use Infobip\Resources\ModelInterface;

final class File implements ModelInterface
{
    /** @var string */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'url' => $this->url,
        ]);
    }
}
