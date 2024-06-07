<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BogoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/discounts', [BogoController::class,'calculateDiscounts']);
