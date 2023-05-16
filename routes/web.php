<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
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

Route::resource('/purchases', PurchaseController::class);

Route::post('/purchase/createvendor', [PurchaseController::class, 'createVendor'])->name('purchases.createVendor');

Route::post('/purchase/addvendor', [PurchaseController::class, 'addVendor'])->name('purchases.addVendor');

Route::post('/purchase/addproduct', [PurchaseController::class, 'addProduct'])->name('purchases.addProduct');

Route::post('/purchase/removeproduct', [PurchaseController::class, 'removeProduct'])->name('purchases.removeProduct');

Route::get('/purchase/cancel', [PurchaseController::class, 'cancelPurchase'])->name('purchases.cancel');

// Route::resource('/orderdetail', OrderDetailController::class);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/addcustomer', [CartController::class, 'addCustomer'])->name('cart.addCustomer');
Route::post('/cart/addproducts', [CartController::class, 'addProducts'])->name('cart.addProducts');
Route::post('/cart/reducequantity', [CartController::class, 'reduceQuantity'])->name('cart.reduceQuantity');
Route::post('/cart/removeproduct', [CartController::class, 'removeProduct'])->name('cart.removeProduct');
Route::post('/cart/addship', [CartController::class, 'addShip'])->name('cart.addShip');
Route::get('/cart/cancelCart', [CartController::class, 'cancelCart'])->name('cart.cancel');