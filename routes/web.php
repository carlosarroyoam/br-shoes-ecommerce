<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Orders\OrderDetailController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\ProductPropertyController;
use App\Http\Controllers\Products\ProductPropertyTypeController;
use App\Http\Controllers\Products\ProductVariantController;
use App\Http\Controllers\Shipments\ShipmentController;
use App\Http\Controllers\ShoppingBag\ShoppingBagController;
use App\Http\Controllers\Users\UserAccountController;
use App\Http\Controllers\Users\UserContactDetailController;
use App\Http\Controllers\Users\UserController;
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
Route::view('', 'pages.home')->name('home');
Route::view('tank-you', 'pages.home')->name('tank-you');
Route::view('sizes-guide', 'pages.home')->name('sizes-guide');
Route::view('how-to-buy', 'pages.home')->name('how-to-buy');
Route::view('faq', 'pages.home')->name('faq');

Route::get('products/newest', [ProductController::class, 'newest'])->name('products.newest');
Route::get('products/offers', [ProductController::class, 'offers'])->name('products.offers');

Route::resource('users', UserController::class)->except('create', 'store');

Route::resources([
    'user-contact-details' => UserContactDetailController::class,
    'user-shipping-addresses' => UserShippingAddressController::class,
    'products' => ProductController::class,
    'product-variants' =>  ProductVariantController::class,
    'product-properties' =>  ProductPropertyController::class,
    'product-property-types' =>  ProductPropertyTypeController::class,
    'categories' => CategoryController::class,
    'orders' => OrderController::class,
    'order-details' => OrderDetailController::class,
    'shipments' => ShipmentController::class,
]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserProfileController::class, 'show'])->name('users.profile');
    Route::get('account-settings', [UserAccountController::class, 'show'])->name('users.account-settings');
    Route::resource('shopping-bag', ShoppingBagController::class)->except('index', 'create', 'edit');
    Route::resource('wish-list', WishListController::class)->except('index', 'create', 'edit');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('admin.dashboard');
