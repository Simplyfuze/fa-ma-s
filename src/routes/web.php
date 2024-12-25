<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login.index');

