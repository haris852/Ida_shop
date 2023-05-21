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
        $this->review->create([
            'transaction_id' => $id,
            'rating' => $attributes['rating'],
            'review' => $attributes['review']
        ]);
    }
}
