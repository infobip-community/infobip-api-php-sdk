<?php

declare(strict_types=1);

namespace Infobip\Resources\SMS\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\SMS\Enums\TrackingType;
use Infobip\Resources\SMS\Enums\TrackType;

final class Tracking implements ModelInterface
{
    /** @var string|null */
    private $baseUrl;

    /** @var string|null */
    private $processKey;

    /** @var TrackType|null */
    private $track;

    /** @var TrackingType|null */
    private $type;

    public function setBaseUrl(?string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    public function setProcessKey(?string $processKey): self
    {
        $this->processKey = $processKey;

        return $this;
    }

    public function setTrack(?TrackType $track): self
    {
        $this->track = $track;

        return $this;
    }

    public function setType(?TrackingType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'baseUrl' => $this->baseUrl,
            'processKey' => $this->processKey,
            'track' => $this->track ? $this->track->getValue() : null,
            'type' => $this->type ? $this->type->getValue() : null
        ]);
    }
}
