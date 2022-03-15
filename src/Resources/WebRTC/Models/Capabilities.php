<?php

declare(strict_types=1);

namespace Infobip\Resources\WebRTC\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WebRTC\Enums\Recording;

final class Capabilities implements ModelInterface
{
    /** @var Recording|null */
    private $recording = null;

    public function setRecording(?Recording $recording): self
    {
        $this->recording = $recording;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'recording' => $this->recording,
        ]);
    }
}
