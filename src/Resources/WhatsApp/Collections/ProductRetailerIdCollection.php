<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Collections;

use Infobip\Resources\BaseCollection;
use Infobip\Resources\WhatsApp\Models\ProductRetailerId;

final class ProductRetailerIdCollection extends BaseCollection
{
    public function add(ProductRetailerId $productRetailerIds): self
    {
        $this->items[] = $productRetailerIds;

        return $this;
    }
}
