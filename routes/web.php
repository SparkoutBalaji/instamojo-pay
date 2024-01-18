<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;

Route::get('event', [PayController::class, 'index']);
Route::post('pay', [PayController::class, 'pay']);
Route::get('pay-success', [PayController::class, 'success']);
