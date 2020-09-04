<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::view('', 'pages.home')->name('home');
Route::view('tank-you', 'pages.home')->name('tank-you');
Route::view('sizes-guide', 'pages.home')->name('sizes-guide');
Route::view('how-to-buy', 'pages.home')->name('how-to-buy');
Route::view('faq', 'pages.home')->name('faq');

Route::get('profile', 'Users\UserProfileController@show')->name('users.profile');
Route::get('account-settings', 'Users\AccountController@show')->name('users.account-settings');
Route::get('products/newest', 'Products\ProductController@newest')->name('products.newest');
Route::get('products/offers', 'Products\ProductController@offers')->name('products.offers');

Route::resource('user', 'Users\UserController')->except('create', 'store');
Route::resource('shopping-bag', 'ShoppingBag\ShoppingBagController')->except('index', 'create', 'edit');
Route::resource('wish-list', 'WishList\WishListController')->except('index', 'create', 'edit');
Route::resources([
    'user-contact-detail' => 'Users\UserContactDetailController',
    'user-shipping-address' => 'Users\UserShippingAddressController',
    'products' =>'Products\ProductController',
    'product-variant' => 'Products\ProductVariantController',
    'product-property' => 'Products\ProductPropertyController',
    'product-property-type' => 'Products\ProductPropertyTypeController',
    'categories' =>'Categories\CategoryController',
    'order' => 'Orders\OrderController',
    'order-detail' => 'Orders\OrderDetailController',
    'shipment' => 'Shipments\ShipmentController',
]);

Route::group(['prefix' => 'admin'], function () {
    Route::get('', 'Admin\DashboardController@index')->name('admin.dashboard');
});
