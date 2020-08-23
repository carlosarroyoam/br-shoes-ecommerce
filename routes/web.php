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

Route::get('', 'Pages\HomeController@index')->name('home');
Route::get('catalog', 'Pages\HomeController@index')->name('catalog');
Route::get('newest', 'Pages\HomeController@index')->name('newest');
Route::get('offers', 'Pages\HomeController@index')->name('offers');
Route::view('tank-you', 'pages.home')->name('tank-you');

Route::resource('shopping-bag', 'Pages\ShoppingBagController')->except([
    'create', 'show', 'edit'
]);
Route::resource('products', 'ProductController');
Route::resource('products.categories', 'ProductCategoryController')->shallow();
Route::resource('products.pictures', 'ProductPictureController')->shallow();
Route::resource('categories', 'CategoryController');
Route::resource('orders', 'OrderController');
Route::resource('users', 'UserController')->except([
    'create', 'store'
]);
Route::resource('users.profile-pictures', 'UserProfilePictureController')->shallow();

Route::group(['prefix' => 'admin'], function () {
    Route::get('', 'Pages\DashboardController@index')->name('admin.dashboard');
});
