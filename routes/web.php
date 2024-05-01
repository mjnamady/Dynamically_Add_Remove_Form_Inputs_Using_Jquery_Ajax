<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('product/store', [ProductController::class, 'ProductStore'])->name('product.store');
