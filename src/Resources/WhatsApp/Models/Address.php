<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class Address implements ModelInterface
{
    /** @var string */
    private $street;

    /** @var string */
    private $city;

    /** @var string */
    private $zip;

    /** @var string */
    private $country;

    /** @var string */
    private $countryCode;

    /** @var string */
    private $type;

    public function __construct(
        string $street,
        string $city,
        string $zip,
        string $country,
        string $countryCode,
        string $type
    ) {
        $this->street = $street;
        $this->city = $city;
        $this->zip = $zip;
        $this->country = $country;
        $this->countryCode = $countryCode;
        $this->type = $type;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'street' => $this->street,
            'city' => $this->city,
            'zip' => $this->zip,
            'country' => $this->country,
            'countryCode' => $this->countryCode,
            'type' => $this->type,
        ]);
    }
}
