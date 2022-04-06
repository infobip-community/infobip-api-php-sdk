<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\WhatsApp\Contracts\ContentInterface;
use Infobip\Validations\Rules;
use Infobip\Validations\Rules\BetweenLengthRule;
use Infobip\Validations\Rules\LatitudeRule;
use Infobip\Validations\Rules\LongitudeRule;

final class LocationContent implements ContentInterface
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

    public function rules(): Rules
    {
        return (new Rules())
            ->addRule(new LatitudeRule('content.latitude', $this->latitude))
            ->addRule(new LongitudeRule('content.longitude', $this->longitude))
            ->addRule(new BetweenLengthRule('content.name', $this->name, 0, 1000))
            ->addRule(new BetweenLengthRule('content.address', $this->address, 0, 1000));
    }
}
