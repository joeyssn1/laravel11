<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;


Route::get('/home', function () {
    return view('home', [
        "pagetitle" => "Santo's Restaurant"
    ]);
})->name('home');

Route::get('/table', function () {
    return view('tableList', [
        "pagetitle" => "Table List"
    ]);
});

Route::get('/menu', function () {
    return view('menu', [
        "pagetitle" => "Menu Page"
    ]);
});



// for User Menu
Route::get('/userMenu', [MenuController::class, 'getMenu'])->name('menu.index');
Route::post('/menu/order/{id}', [MenuController::class, 'order'])->name('menu.order');
Route::post('/menu/order/{id}', [MenuController::class, 'updateQuantity'])->name('menu.order');


Route::get('/menu', [MenuController::class, 'getMenuforPayment'])->name('menu');

// for Add menu
Route::get('/addMenu', [MenuController::class, 'create'])->name('menu.create');
Route::post('/addMenu', [MenuController::class, 'store'])->name('menu.store');

// for Payment
Route::get('/payment', [PaymentController::class, 'getAllOrderDetail'])->name('payment');
Route::post('/payment', [PaymentController::class, 'getAllOrderDetail'])->name('payment');

Route::get('/paymentmethod',[PaymentController::class, 'getPaymentMethod'])->name('paymentMethod');

Route::get('/PaymentStatus',[PaymentController::class, 'getPaymentStatus'])->name('paymentStatus');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
});

// Route for editing a menu
Route::get('/menu/{id}/edit', [MenuController::class, 'showEditForm'])->name('menu.edit');
Route::post('/menu/{id}/edit', [MenuController::class, 'edit']);

// Route for deleting a menu
Route::post('/menu/{id}/delete', [MenuController::class, 'delete'])->name('menu.delete');


