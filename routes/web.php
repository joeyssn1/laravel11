<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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


Route::get('/menu', [MenuController::class, 'getMenuforPayment'])->name('menu');

// for Add menu
Route::get('/addMenu', [MenuController::class, 'create'])->name('menu.create');
Route::post('/addMenu', [MenuController::class, 'store'])->name('menu.store');


Route::get('/payment', [PaymentController::class, 'getAllOrderDetail'])->name('payment');


Route::get('/paymentmethod',[PaymentController::class, 'getPaymentMethod'])->name('paymentMethod');

Route::get('/PaymentStatus',[PaymentController::class, 'getPaymentStatus'])->name('paymentStatus');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
