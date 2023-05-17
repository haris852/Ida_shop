<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Observers\ProductObserver;
use App\Observers\ReviewObserver;
use App\Observers\TransactionDetailObserve;
use App\Observers\TransactionObserve;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\ProductInterface::class, \App\Repositories\ProductRepository::class);
        $this->app->bind(\App\Interfaces\UserInterface::class, \App\Repositories\UserRepository::class);
        $this->app->bind(\App\Interfaces\TransactionInterface::class, \App\Repositories\TransactionRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
        Transaction::observe(TransactionObserve::class);
        TransactionDetail::observe(TransactionDetailObserve::class);
        Review::observe(ReviewObserver::class);
    }
}
