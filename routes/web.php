<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StoreConfigurationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('register/store', [LoginController::class, 'registerStore'])->name('register.store');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('login/store', [LoginController::class, 'loginStore'])->name('login.store');
Route::get('login', [LoginController::class, 'index'])->name('login');

Route::get('/', function () {
    return view('customer.layout.master');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'role.admin']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', DashboardController::class)->name('admin.dashboard');

    // Setting
    Route::post('setting/user/list', [SettingController::class, 'store'])->name('admin.setting.user.list');

    // Setting
    Route::resource('setting', SettingController::class, ['as' => 'admin']);

    // Product
    Route::resource('product', ProductController::class, ['as' => 'admin']);

    //User
    Route::resource('user', UserController::class, ['as' => 'admin']);

    // Configuration Store
    Route::resource('store-configuration', StoreConfigurationController::class, ['as' => 'admin']);
});
