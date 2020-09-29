<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\Categories\CategoryController;

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
]);

Route::resource('users', UserController::class)->except('create', 'store');
