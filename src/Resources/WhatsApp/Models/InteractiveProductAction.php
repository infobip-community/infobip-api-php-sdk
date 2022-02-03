<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;

final class InteractiveProductAction implements ModelInterface
{
    /** @var string */
    private $catalogId;

    /** @var string */
    private $productRetailerId;

    public function __construct(
        string $catalogId,
        string $productRetailerId
    ) {
        $this->catalogId = $catalogId;
        $this->productRetailerId = $productRetailerId;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'catalogId' => $this->catalogId,
            'productRetailerId' => $this->productRetailerId,
        ]);
    }
}
