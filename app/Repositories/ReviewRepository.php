<?php

namespace App\Repositories;

use App\Interfaces\ReviewInterface;
use App\Models\Review;
use App\Models\TransactionDetail;

class ReviewRepository implements ReviewInterface
{
    private $review;
    private $transactionDetail;

    public function __construct(Review $review, TransactionDetail $transactionDetail) {
        $this->review = $review;
        $this->transactionDetail = $transactionDetail;
    }

    public function store($attributes, $id)
    {
        $products = $this->transactionDetail->where('transaction_id', $id)->get();
        foreach ($products as $product) {
            $attributes['product_id'] = $product->product_id;
            $this->review->create([
                'transaction_id' => $id,
                'product_id'     => $product->product_id,
                'rating'         => $attributes['rating'],
                'review'         => $attributes['review']
            ]);
        }
    }
}
