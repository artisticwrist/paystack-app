<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('pay', [PaymentController::class, 'pay']);
Route::post('pay', [PaymentController::class, 'make_payment'])->name('pay');
Route::get('pay/callback', [PaymentController::class, 'payment_callback'])->name('callback');
