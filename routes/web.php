<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

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
});


Route::post('/checkout', [StripeController::class, 'index']);
Route::post('/update', [StripeController::class, 'update']);
Route::post('/delete', [StripeController::class, 'delete']);
Route::post('/paymethod', [StripeController::class, 'paymethod']);
Route::post('/user/edit', [StripeController::class, 'updateUserTV']);

Route::get('/getall', [StripeController::class, 'getall']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
