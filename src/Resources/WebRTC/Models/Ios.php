<?php

declare(strict_types=1);

namespace Infobip\Resources\WebRTC\Models;

use Infobip\Resources\ModelInterface;

final class Ios implements ModelInterface
{
    /** @var string */
    private $fcmServerKey;

    public function __construct(string $fcmServerKey)
    {
        $this->fcmServerKey = $fcmServerKey;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'fcmServerKey' => $this->fcmServerKey,
        ]);
    }
}
