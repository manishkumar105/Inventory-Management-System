<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// auth
Route::get('/',[AuthController::class,'showregistration'])->name('auth.showRegistration');
Route::post('registration',[AuthController::class,'registration'])->name('auth.registration');
Route::get('login',[AuthController::class,'showlogin'])->name('auth.showLogin');
Route::post('login',[AuthController::class,'login'])->name('auth.login');
// Route::get('dashboard',function() { return view('auth.dashboard'); })->name('auth.dashboard');
Route::post('logout',[AuthController::class,'logout'])->name('auth.logout');

//end auth


Route::resource('products', ProductController::class)->except(['show']);
//for any invalid url
// Route::fallback(function () {
//     return redirect()->route('products.index');
// });
//end for any invalid url

Route::get('products/{product}/transactions/create', [InventoryTransactionController::class, 'create'])->name('transactions.create');
Route::post('products/{product}/transactions', [InventoryTransactionController::class, 'store'])->name('transactions.store');
Route::get('products/{product}/transactions', [InventoryTransactionController::class, 'history'])->name('transactions.history');
