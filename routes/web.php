<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin_dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin_dashboard');
//Route::get('/admin_dashboard/{parameter}', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin_dashboard');

Route::get('/client_dashboard', [App\Http\Controllers\Client\DashboardController::class, 'index'])->name('client_dashboard');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Acciones
Route::post('/rooms', [App\Http\Controllers\RoomController::class, 'create'])->name('rooms.create'); // Crear y actualizar

Route::delete('/rooms_delete/{id}', [App\Http\Controllers\RoomController::class, 'delete'])->name('rooms.delete'); // eliminar

Route::post('/reservations', [App\Http\Controllers\ReservationController::class, 'create'])->name('reservations.create'); // Crear  
Route::post('/reservations/{reservationId}/update-status', [App\Http\Controllers\ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
