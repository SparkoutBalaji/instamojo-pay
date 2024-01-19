<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;

Route::get('/', [PayController::class, 'index'])->name('index');
Route::post('pay', [PayController::class, 'pay']);
Route::get('pay-success', [PayController::class, 'success'])->name('success');
Route::get('/request/lists',[PayController::class, 'requests'])->name('requests');
Route::post('/request/id',[PayController::class, 'rd'])->name('rd');
