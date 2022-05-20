<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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

Auth::routes();



Route::group(['middleware'=>['auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware'=>['roles:1']], function(){
        Route::controller(ProductController::class)->group(function()
    {
            Route::get('/products', 'create')->name('products.create');
            Route::post('/product', 'store')->name('product.store');
            Route::get('product', 'index')->name('product.index');
            Route::get('product/{id}/edit', 'edit')->name('product.edit');
            Route::post('product/{id}', 'update')->name('product.update');
            Route::delete('/product/{id}', 'destroy')->name('product.destroy');
        });
    });
    

    Route::controller(OrderController::class)->group(function()
    {
        Route::get('/order/create', 'create')->name('order.create');
        Route::post('/order', 'store')->name('order.store');
        Route::get('order', 'index')->name('order.index');
        Route::get('order/{id}/edit', 'edit')->name('order.edit');
        Route::post('order/{id}', 'update')->name('order.update');
    });

});