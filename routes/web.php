<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index'])->name('index.index');
Route::resource('/orders', OrderController::class);
Route::post('/orders/{id}/status', [OrderController::class, 'changeStatus'])->name('orders.changeStatus');
Route::resource('/products', ProductController::class);
Route::resource('/customers', CustomerController::class);
// Route::resource('/orderdetail', OrderDetailController::class);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/addcustomer', [CartController::class, 'addCustomer'])->name('cart.addCustomer');
Route::post('/addproducts', [CartController::class, 'addProducts'])->name('cart.addProducts');
Route::post('/reducequantity', [CartController::class, 'reduceQuantity'])->name('cart.reduceQuantity');
Route::post('/removeproduct', [CartController::class, 'removeProduct'])->name('cart.removeProduct');
Route::post('/addship', [CartController::class, 'addShip'])->name('cart.addShip');
Route::get('/cancelCart', [CartController::class, 'cancelCart'])->name('cart.cancel');
