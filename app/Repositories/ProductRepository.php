<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductInterface
{
    private $product;

    public function __construct(Product $product)
    {
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

    public function update($id, $data)
    {
        try {
            $product = $this->product->find($id);
            if (isset($data['image'])) {
                $oldImage = $product->image;
                if ($oldImage != null) {
                    Storage::delete('public/product/' . $oldImage);
                }
                $filename = uniqid() . $data['image']->getClientOriginalName();
                $data['image']->storeAs('public/product', $filename);
                $product->image = $filename;
            }
            $product->name = $data['name'];
            $product->category = $data['category'];
            $product->weight = $data['weight'];
            $product->stock = $data['stock'];
            $product->unit = $data['unit'];
            $product->price = $data['price'];
            $product->description = $data['description'];
            $product->save();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function store($data)
    {
        try {
            $filename = uniqid() . $data['image']->getClientOriginalName();
            $data['image']->storeAs('public/product', $filename);
            $this->product->create(array_merge($data, ['image' => $filename]));

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getCategories()
    {
        return $this->product->select('category')->groupBy('category')->get();
    }
}
