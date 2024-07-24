<?php

use App\Http\Controllers\ClientPaymentController;
use App\Http\Middleware\MidtransSignatureKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware([MidtransSignatureKey::class])->group(function () {
    Route::post('/midtrans-callback', [ClientPaymentController::class, 'callback']);
});