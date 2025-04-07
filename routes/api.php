<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', UserController::class);
});

Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::controller(AdminUserController::class)
            ->prefix('users')
            ->name('users.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{user}', 'show')->name('show');
                Route::patch('/{user}/update', 'update')->name('update');
                Route::post('/create', 'store')->name('store');
                Route::delete('/{user}', 'destroy')->name('delete');
            });

        Route::get('dashboard', AdminDashboardController::class)
            ->name('dashboard');
    });
