<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\ProductPropertyController;
use App\Http\Controllers\Products\ProductPropertyTypeController;
use App\Http\Controllers\Products\ProductVariantController;

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

Route::resources([
    'products' => ProductController::class,
    'product-variants' =>  ProductVariantController::class,
    'product-properties' =>  ProductPropertyController::class,
    'product-property-types' =>  ProductPropertyTypeController::class,
    'categories' => CategoryController::class,
]);
