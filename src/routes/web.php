<?php

use App\Http\Controllers\ConsumableController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', function (){return inertia('login');})->name('login')->middleware('guest');
    Route::post('/login',[SessionController::class, 'store'])->name('login.store')->middleware('guest');
});



Route::middleware(['auth'])->group(function () {
    Route::post('/logout',[SessionController::class, 'destroy'])->name('logout');


    Route::middleware('role:worker')->group(function () {
        Route::prefix('equipments')->group(function () {
            Route::get('/', [EquipmentController::class, 'index'])->name('equipments.index');
            Route::get('/create', [EquipmentController::class, 'create'])->name('equipments.create');
            Route::post('/create', [EquipmentController::class, 'store'])->name('equipments.store');
            // TODO: Policy can update equipment
            Route::get('/{id}', [EquipmentController::class, 'show'])->name('equipments.show');
            Route::post('/{id}/update', [EquipmentController::class, 'update'])->name('equipments.update');
            // TODO: Policy can delete equipment
            Route::post('/{id}/delete', [EquipmentController::class, 'destroy'])->name('equipments.destroy');
        });

        Route::prefix('consumables')->group(function () {
            Route::get('/', [ConsumableController::class, 'index'])->name('consumable.index');
            Route::get('/create', [ConsumableController::class, 'create'])->name('consumable.create');
            Route::post('/create', [ConsumableController::class, 'store'])->name('consumable.store');
            Route::get('/{id}', [ConsumableController::class, 'show'])->name('consumable.show');
            Route::post('/{id}/update', [ConsumableController::class, 'update'])->name('consumable.update');
            Route::post('/{id}/delete', [ConsumableController::class, 'destroy'])->name('consumable.destroy');
        });

        Route::prefix('fields')->group(function () {
            Route::get('/', [FieldController::class, 'index'])->name('field.index');
            Route::get('/create', [FieldController::class, 'create'])->name('field.create');
            Route::post('/create', [FieldController::class, 'store'])->name('field.store');
            Route::get('/{id}', [FieldController::class, 'show'])->name('field.show');
            Route::post('/{id}/update', [FieldController::class, 'update'])->name('consumable.update');
            Route::get('/{id}/delete', [FieldController::class, 'destroy'])->name('field.destroy');
        });
        Route::prefix('tasks')->group(function () {
            Route::get('/create', [TaskController::class, 'create'])->name('task.create');
            Route::post('/create', [TaskController::class, 'store'])->name('task.store');
            Route::post('/{id}/update', [TaskController::class, 'update'])->name('task.update');
            Route::post('/{id}/delete', [TaskController::class, 'destroy'])->name('task.destroy');
        });
    });


    Route::get('tasks/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/', [GroupController::class, 'index'])->name('index');
    Route::get('/groups/{id}', [GroupController::class, 'show'])->name('groups.show');

    Route::middleware('admin')->group(function () {

        Route::prefix('groups')->group(function () {
            Route::get('/create', [GroupController::class, 'create'])->name('groups.create');
            Route::post('/create', [GroupController::class, 'store'])->name('groups.store');
            Route::post('/{id}/delete', [GroupController::class, 'destroy'])->name('groups.destroy');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/create', [UserController::class, 'store'])->name('users.store');
            Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
            Route::post('/{id}/update', [UserController::class, 'update'])->name('users.update');
            Route::post('/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
        });

    });
});


