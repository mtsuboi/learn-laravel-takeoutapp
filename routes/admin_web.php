<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\OrderController;

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
    return view('admin.welcome');
});

Route::resource('items', ItemController::class)->middleware('auth:admin');

Route::get('orderitems', [OrderItemController::class, 'index'])
    ->middleware('auth:admin')->name('orderitems.index');

Route::prefix('orders')->middleware('auth:admin')->group(function(){
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('show/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('print', [OrderController::class, 'print'])->name('orders.print');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin'])->name('dashboard');

require __DIR__.'/admin_auth.php';
