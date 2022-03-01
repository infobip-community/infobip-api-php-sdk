<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Contracts\TemplateHeaderInterface;
use Infobip\Resources\WhatsApp\Enums\TemplateHeaderType;

final class LocationTemplateHeader implements TemplateHeaderInterface
{
    /** @var TemplateHeaderType */
    private $type;

    /** @var int */
    private $latitude;

    /** @var int */
    private $longitude;

    public function __construct(
        int $latitude,
        int $longitude
    ) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->type = new TemplateHeaderType(TemplateHeaderType::LOCATION);
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'type' => $this->type->getValue(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);
    }
}
