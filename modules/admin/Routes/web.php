<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\Categories\CategoryController;
use Modules\Admin\Http\Controllers\Products\ProductController;
use Modules\Admin\Http\Controllers\Products\ProductPropertyController;
use Modules\Admin\Http\Controllers\Products\ProductPropertyValueController;
use Modules\Admin\Http\Controllers\Products\ProductVariantController;

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
    return redirect()->route('admin.dashboard');
});

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])->get('/dashboard', function () {
    return view('admin::pages.dashboard.index');
})->name('dashboard');

Route::resources([
    'categories' => CategoryController::class,
    'products' => ProductController::class,
    'product-variants' =>  ProductVariantController::class,
    'product-properties' =>  ProductPropertyController::class,
    'product-property-values' =>  ProductPropertyValueController::class,
]);

Route::resource('users', UserController::class)->except('create', 'store');
