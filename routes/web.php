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

Route::group(['prefix' => 'admin'], function () {
    Route::get('', 'Admin\DashboardController@index')->name('admin.dashboard');
});

Route::resources([
    'products' =>'Products\ProductController',
    'categories' =>'Categories\CategoryController',
]);


Route::resource('user', 'Users\UserController')->except('create', 'store');

Route::resource('user-contact-detail', 'Users\UserContactDetailController');

Route::resource('user-shipping-address', 'Users\UserShippingAddressController');

Route::resource('user-profile-pictures', 'Users\UserProfilePicturesController')->except('index');

Route::resource('order', 'Orders\OrderController');

Route::resource('order-detail', 'Orders\OrderDetailController');

Route::resource('shipment', 'Shipments\ShipmentController');

Route::resource('product-pictures', 'Products\ProductPicturesController');

Route::resource('shopping-bag', 'ShoppingBag\ShoppingBagController')->except('index', 'create', 'edit');

Route::resource('wish-list', 'WishList\WishListController')->except('index', 'create', 'edit');


Route::resource('user', 'Users\UserController')->except('create', 'store');

Route::resource('user-contact-detail', 'Users\UserContactDetailController');

Route::resource('user-shipping-address', 'Users\UserShippingAddressController');

Route::resource('order', 'Orders\OrderController');

Route::resource('order-detail', 'Orders\OrderDetailController');

Route::resource('shipment', 'Shipments\ShipmentController');

Route::resource('product-pictures', 'Products\ProductPicturesController');

Route::resource('shopping-bag', 'ShoppingBag\ShoppingBagController')->except('index', 'create', 'edit');

Route::resource('wish-list', 'WishList\WishListController')->except('index', 'create', 'edit');


Route::resource('user', 'Users\UserController')->except('create', 'store');

Route::resource('user-contact-detail', 'Users\UserContactDetailController');

Route::resource('user-shipping-address', 'Users\UserShippingAddressController');

Route::resource('order', 'Orders\OrderController');

Route::resource('order-detail', 'Orders\OrderDetailController');

Route::resource('shipment', 'Shipments\ShipmentController');

Route::resource('shopping-bag', 'ShoppingBag\ShoppingBagController')->except('index', 'create', 'edit');

Route::resource('wish-list', 'WishList\WishListController')->except('index', 'create', 'edit');


Route::resource('user', 'Users\UserController')->except('create', 'store');

Route::resource('user-contact-detail', 'Users\UserContactDetailController');

Route::resource('user-shipping-address', 'Users\UserShippingAddressController');

Route::resource('product-variant', 'Products\ProductVariantController');

Route::resource('product-property', 'Products\ProductPropertyController');

Route::resource('product-property-type', 'Products\ProductPropertyTypeController');

Route::resource('order', 'Orders\OrderController');

Route::resource('order-detail', 'Orders\OrderDetailController');

Route::resource('shipment', 'Shipments\ShipmentController');

Route::resource('shopping-bag', 'ShoppingBag\ShoppingBagController')->except('index', 'create', 'edit');

Route::resource('wish-list', 'WishList\WishListController')->except('index', 'create', 'edit');
