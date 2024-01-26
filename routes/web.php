<?php

use App\Events\MessageEvent;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductContrroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/product/{id}', [HomeController::class, 'show'])->name('product');
    Route::get('/my-order', [OrderController::class, 'myOrder'])->name('myOrder');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    Route::middleware(['checkUserRole:admin'])->group(function () {
        Route::get('/my-product', [ProductContrroller::class, 'index'])->name('myProduct.index');
        Route::post('/my-product', [ProductContrroller::class, 'store'])->name('myProduct.store');
        Route::delete('/my-product/{id}/delete', [ProductContrroller::class, 'destroy'])->name('myProduct.destroy');
        Route::put('/my-product/{id}/update', [ProductContrroller::class, 'update'])->name('myProduct.update');
    
        Route::get('/room', [ChatController::class, 'listroom'])->name('chatcustomer.listroom');
        Route::get('/chat/{id}/customer', [ChatController::class, 'chatcustomer'])->name('chatcustomer.index');
        
    });

    Route::middleware(['checkUserRole:customer'])->group(function () {
        Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    });

    Route::get('/chat/{id}/room', [ChatController::class, 'chatinroom'])->name('chat.chatinroom');
    Route::get('/chat/{id}/new', [ChatController::class, 'newMessage'])->name('chat.newMessage');

    Route::post('/chat/{id}', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/test', function(){
        MessageEvent::dispatch('agat broadcast','2');
    })->name('chat.test');


});
