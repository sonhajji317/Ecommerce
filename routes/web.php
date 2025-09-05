<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/product/{id}/details', [ProductController::class, 'productDetails']);
Route::get('/product/category/{id}', [ProductController::class, 'filterByCategory'])->name('productAll');
Route::get('/order/{id}', [OrderController::class, 'orderDetails']);
Route::get('/orderList', [OrderController::class, 'index'])->name('orderList');
Route::post('/checkout/{id}', [OrderController::class, 'checkout'])->name('order.checkout');
Route::delete('/order/{id}/delete', [OrderController::class, 'destroy'])->name('order.destroy');
Route::get('/order/{id}/pay', [OrderController::class, 'pay'])->name('order.pay');
Route::get('/about', function () {
    return view('about.index');
})->name('about');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
]);
// ->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
