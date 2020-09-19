<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;

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

Route::resource('users', UserController::class)->except('create', 'store');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])->get('/dashboard', function () {
    return view('pages.admin.index');
})->name('admin.dashboard');
