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

Route::get('', 'HomeController@index')->name('home');
Route::view('tank-you', 'pages.home')->name('tank-you');
Route::view('sizes-guide', 'pages.home')->name('sizes-guide');
Route::view('how-to-buy', 'pages.home')->name('how-to-buy');
Route::view('faq', 'pages.home')->name('faq');

Route::get('profile', 'Users\UserProfileController@show')->name('users.profile');
Route::get('account-settings', 'Users\AccountController@show')->name('users.account-settings');

Route::get('products/newest', 'Products\ProductController@newest')->name('products.newest');
Route::get('products/offers', 'Products\ProductController@offers')->name('products.offers');
Route::resource('products', 'Products\ProductController');
Route::resource('products.categories', 'Products\ProductCategoryController')->shallow();
Route::resource('products.pictures', 'Products\ProductPictureController')->shallow();

Route::resource('categories', 'Products\CategoryController');
Route::resource('checkouts', 'OrderController');
Route::resource('orders', 'OrderController');
Route::resource('shipments', 'ShipmentController');
Route::resource('notifications', 'NotificationsController');

Route::resource('users', 'Users\UserController')->except([
    'create', 'store'
]);
Route::resource('users.profile-pictures', 'Users\UserProfilePictureController')->shallow();
Route::resource('users.conctact-details', 'Users\UserProfilePictureController');
Route::resource('users.shipping-addresses', 'Users\UserProfilePictureController');

Route::resource('shopping-bag', 'ShoppingBagController')->except([
    'create', 'show', 'edit'
]);
Route::resource('wish-list', 'WishListController')->except([
    'create', 'show', 'edit'
]);

Route::group(['prefix' => 'admin'], function () {
    Route::get('', 'Admin\DashboardController@index')->name('admin.dashboard');
});
