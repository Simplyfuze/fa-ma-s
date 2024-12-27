<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', function (){return inertia('login');})->name('login')->middleware('guest');
    Route::post('/login',[SessionController::class, 'store'])->name('login.store')->middleware('guest');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return inertia('index');
    });

    Route::get('/groups', function () {
        return inertia('Groups/index');
    });

    Route::post('/logout',[SessionController::class, 'destroy'])->name('logout');
});
