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

    public function getById($id)
    {
        return $this->product->find($id);
    }

    public function delete($id)
    {
        return $this->product->find($id)->update(['is_active' => 0]);
    }
}

