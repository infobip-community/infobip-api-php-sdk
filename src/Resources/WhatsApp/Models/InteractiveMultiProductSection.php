<?php

declare(strict_types=1);

namespace Infobip\Resources\WhatsApp\Models;

use Infobip\Resources\ModelInterface;
use Infobip\Resources\WhatsApp\Collections\ProductRetailerIdCollection;

final class InteractiveMultiProductSection implements ModelInterface
{
    /** @var string|null */
    private $title;

    /** @var ProductRetailerIdCollection */
    private $productRetailerIds;

    public function __construct()
    {
        $this->productRetailerIds = new ProductRetailerIdCollection();
    }

    public function addProductRetailerId(ProductRetailerId $productRetailerIds): self
    {
        $this->productRetailerIds->add($productRetailerIds);
        return $this;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter_recursive([
            'title' => $this->title,
            'productRetailerIds' => $this->productRetailerIds->toArray(),
        ]);
    }
}
