<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;

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

Route::get('/', function () {
    return view('user.welcome');
});

Route::get('news', function () {
    return view('user.news');
})->name('news');

Route::get('concept', function () {
    return view('user.concept');
})->name('concept');

Route::get('access', function () {
    return view('user.access');
})->name('access');

Route::middleware('auth:users')->group(function(){
    Route::get('items', [ItemController::class, 'index'])->name('items.index');
    Route::get('show/{id}', [ItemController::class, 'show'])->name('items.show');
});

Route::prefix('cart')->middleware('auth:users')->group(function(){
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'add'])->name('cart.add');
    Route::post('store', [CartController::class, 'store'])->name('cart.store');
    Route::delete('delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
});

Route::prefix('orders')->middleware('auth:users')->group(function(){
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::post('cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

require __DIR__.'/auth.php';
