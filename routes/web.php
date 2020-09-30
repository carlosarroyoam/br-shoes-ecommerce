<?php

use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\ProductPropertyController;
use App\Http\Controllers\Products\ProductPropertyValueController;
use App\Http\Controllers\Products\ProductVariantController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Log;
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

Route::get('', function () {
    SEOMeta::setTitle(__('navigation.home'));
    return view('pages.home');
})->name('home');

Route::view('sizes-guide', function () {
    SEOMeta::setTitle(__('navigation.sizes-guide'));
    return view('pages.home');
})->name('sizes-guide');

Route::view('how-to-buy', function () {
    SEOMeta::setTitle(__('navigation.how-to-buy'));
    return view('pages.home');
})->name('how-to-buy');

Route::view('faq', function () {
    SEOMeta::setTitle(__('navigation.home'));
    return view('pages.home');
})->name('faq');

Route::view('tank-you', function () {
    SEOMeta::setTitle(__('navigation.tank-you'));
    return view('pages.home');
})->name('tank-you');

Route::get('products/newest', [ProductController::class, 'newest'])->name('products.newest');
Route::get('products/offers', [ProductController::class, 'offers'])->name('products.offers');

/* Sitemap Routes */
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');
Route::get('/sitemap.xml/page', [SitemapController::class, 'pages']);
Route::get('/sitemap.xml/product', [SitemapController::class, 'products']);
Route::get('/sitemap.xml/category', [SitemapController::class, 'categories']);
Route::get('/sitemap.xml/collection', [SitemapController::class, 'collections']);

Route::resource('categories', CategoryController::class)->only([
    'index', 'show'
]);

Route::resource('products', ProductController::class)->only([
    'index', 'show'
]);
