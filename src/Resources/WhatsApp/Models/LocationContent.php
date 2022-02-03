<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class LocationContent implements ModelInterface
{
    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /** @var string|null */
    private $name = null;

    /** @var string|null */
    private $address = null;

    public function __construct(
        float $latitude,
        float $longitude
    ) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'name' => $this->name,
            'address' => $this->address,
        ]);
    }
}
