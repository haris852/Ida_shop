<?php

namespace App\Observers;

class ProductObserver
{
    public function creating($model)
    {
        if (auth()->check()) {
            $model->created_by = auth()->user()->id;
        }
    }

    public function updating($model)
    {
        if (auth()->check()) {
            $model->updated_by = auth()->user()->id;
        }
    }
}
