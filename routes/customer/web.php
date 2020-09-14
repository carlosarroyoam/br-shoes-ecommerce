<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Orders\OrderDetailController;
use App\Http\Controllers\Shipments\ShipmentController;
use App\Http\Controllers\ShoppingBag\ShoppingBagController;
use App\Http\Controllers\Users\UserAccountController;
use App\Http\Controllers\Users\UserContactDetailController;
use App\Http\Controllers\Users\UserProfileController;
use App\Http\Controllers\Users\UserShippingAddressController;
use App\Http\Controllers\WishList\WishListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserProfileController::class, 'show'])->name('users.profile');
    Route::get('account-settings', [UserAccountController::class, 'show'])->name('users.account-settings');
    Route::resource('shopping-bag', ShoppingBagController::class)->except('index', 'create', 'edit');
    Route::resource('wish-list', WishListController::class)->except('index', 'create', 'edit');


    Route::resources([
        'user-contact-details' => UserContactDetailController::class,
        'user-shipping-addresses' => UserShippingAddressController::class,
        'orders' => OrderController::class,
        'order-details' => OrderDetailController::class,
        'shipments' => ShipmentController::class,
    ]);
});
