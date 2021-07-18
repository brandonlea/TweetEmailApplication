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
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/forgot-password', function () {
   return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/webhook',[\App\Http\Controllers\WebhookController::class, 'handle']);
Route::post('/webhook',[\App\Http\Controllers\WebhookController::class, 'handle']);

require __DIR__.'/auth.php';
