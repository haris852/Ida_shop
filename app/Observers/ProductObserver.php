<?php

namespace App\Observers;

class ProductObserver
{
    protected function creating($model)
    {
        if (auth()->check()) {
            $model->created_by = auth()->user()->id;
        }
    }

    protected function updating($model)
    {
        if (auth()->check()) {
            $model->updated_by = auth()->user()->id;
        }
    }
}
