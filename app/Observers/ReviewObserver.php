<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Review;

class ReviewObserver
{
    public function creating($model)
    {
        if (auth()->check()) {
            $model->user_id = auth()->user()->id;
            $model->created_by = auth()->user()->id;
        }
    }

    public function updating($model)
    {
        if (auth()->check()) {
            $model->user_id = auth()->user()->id;
            $model->updated_by = auth()->user()->id;
        }
    }
}
