<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    private $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    public function get()
    {
        return $this->product->get();
    }
}
