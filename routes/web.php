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

Route::get('/', function () {
    return view('user.welcome');
});

Route::get('/news', function () {
    return view('user.news');
})->name('news');

Route::get('/concept', function () {
    return view('user.concept');
})->name('concept');

Route::get('/access', function () {
    return view('user.access');
})->name('access');

Route::get('/order', function () {
    return view('user.order');
})->middleware(['auth:users'])->name('order');

require __DIR__.'/auth.php';
