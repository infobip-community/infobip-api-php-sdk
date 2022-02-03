<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class ProductRetailerId implements ModelInterface
{
    /** @var string */
    private $productRetailerId;

    public function __construct(
        string $productRetailerId
    ) {
        $this->productRetailerId = $productRetailerId;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'productRetailerId' => $this->productRetailerId,
        ]);
    }
}
