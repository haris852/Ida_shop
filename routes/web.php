<?php

use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StoreConfigurationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserMessageController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\User\UserSettingController;
use Illuminate\Support\Facades\Route;

Route::post('reset-password/update', [LoginController::class, 'resetPasswordUpdate'])->name('reset-password.update');
Route::get('reset-password', [LoginController::class, 'resetPassword'])->name('reset-password');
Route::post('forgot-password', [LoginController::class, 'forgotPasswordStore'])->name('forgot-password.store');
Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
Route::post('register/store', [LoginController::class, 'registerStore'])->name('register.store');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('login/store', [LoginController::class, 'loginStore'])->name('login.store');
Route::get('login', [LoginController::class, 'index'])->name('login');

Route::get('menu', [HomeController::class, 'menu'])->name('menu');
Route::post('cart/check-stock', [HomeController::class, 'cartCheckStock'])->name('cart.check-stock');
Route::post('cart/destroy', [HomeController::class, 'cartDestroy'])->name('cart.destroy');
Route::post('cart/store', [HomeController::class, 'cartStore'])->name('cart.store');
Route::post('cart/check-stock', [HomeController::class, 'cartCheckStock'])->name('cart.check-stock');
Route::get('cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// User Setting
Route::group(['prefix' => 'setting', ['middleware' => ['auth']]], function () {
    Route::put('/update/{id}', [UserSettingController::class, 'update'])->name('user.setting.update');
    Route::get('/', [UserSettingController::class, 'index'])->name('user.setting.index');
});

// User Message
Route::group(['prefix' => 'message', ['middleware' => ['auth']]], function () {
    Route::get('/', [UserMessageController::class, 'index'])->name('user.message.index');
    Route::post('/send', [UserMessageController::class, 'send'])->name('user.message.send');
    Route::get('/message', [UserMessageController::class, 'message'])->name('user.message.message');
    Route::post('/message/read', [UserMessageController::class, 'read'])->name('user.message.read');
});

Route::prefix('dashboard')->group(function () {
    Route::get('user/order/{id}/print', [UserOrderController::class, 'print'])->name('user-customer.order.print');
    Route::get('user/order/filter/status', [UserOrderController::class, 'filterStatus'])->name('user-customer.order.filter-status');
    Route::post('user/order/review/{id}', [UserOrderController::class, 'review'])->name('user-customer.order.review');
    Route::post('user/order/confirm/{id}', [UserOrderController::class, 'confirm'])->name('user-customer.order.confirm');
    Route::resource('user/order', UserOrderController::class, ['as' => 'user-customer']);
    Route::resource('checkout', CheckoutController::class, ['as' => 'customer']);
})->middleware(['auth']);

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'role.admin']], function () {
    Route::get('/', DashboardController::class)->name('admin.dashboard');

    // Order
    Route::post('order/filter/yearly', [OrderController::class, 'filterYearly'])->name('admin.order.filter-yearly');
    Route::post('order/filter/monthly', [OrderController::class, 'filterMonthly'])->name('admin.order.filter-monthly');
    Route::get('order/list/detail', [OrderController::class, 'listDetail'])->name('admin.order.list-detail');
    Route::post('order/cod/upload-payment', [OrderController::class, 'uploadPaymentCod'])->name('admin.order.cod.upload-payment');
    Route::post('order/change-status', [OrderController::class, 'changeStatus'])->name('admin.order.change-status');
    Route::resource('order', OrderController::class, ['as' => 'admin']);

    // Setting
    Route::post('setting/user/list', [SettingController::class, 'store'])->name('admin.setting.user.list');

    // Setting
    Route::resource('setting', SettingController::class, ['as' => 'admin']);

    // Product
    Route::resource('product', ProductController::class, ['as' => 'admin']);

    //User
    Route::put('user/activate/{id}', [UserController::class, 'activate'])->name('admin.user.activate');
    Route::get('user/inactive', [UserController::class, 'inactive'])->name('admin.user.inactive');
    Route::resource('user', UserController::class, ['as' => 'admin']);

    // Review
    Route::resource('review', ReviewController::class, ['as' => 'admin']);

    // Configuration Store
    Route::resource('store-configuration', StoreConfigurationController::class, ['as' => 'admin']);

    // Message
    Route::prefix('message')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('admin.message.index');
        Route::get('/{id}', [MessageController::class, 'show'])->name('admin.message.show');
        Route::post('/send', [MessageController::class, 'send'])->name('admin.message.send');
        Route::post('/message/read', [MessageController::class, 'read'])->name('admin.message.read');
    });
});
