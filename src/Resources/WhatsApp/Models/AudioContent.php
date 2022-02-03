<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class AudioContent implements ModelInterface
{
    /** @var string */
    private $mediaUrl;

    public function __construct(
        string $mediaUrl
    ) {
        $this->mediaUrl = $mediaUrl;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'mediaUrl' => $this->mediaUrl,
        ]);
    }
}
