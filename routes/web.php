<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\DoctorsController::class, 'index'])->name('doctors.index');

Route::get('/{doctor_id}/termine', [App\Http\Controllers\AppointmentsController::class, 'create'])->name('doctors.appointments.create');
Route::post('/{doctor_id}/termine', [App\Http\Controllers\AppointmentsController::class, 'store'])->name('doctors.appointments.store');
Route::get('/{doctor_id}/termine/{appointment_id}', [App\Http\Controllers\AppointmentsController::class, 'edit'])->name('doctors.appointments.edit');
Route::patch('/{doctor_id}/termine/{appointment_id}', [App\Http\Controllers\AppointmentsController::class, 'update'])->name('doctors.appointments.update');
Route::delete('/{doctor_id}/termine/{appointment_id}', [App\Http\Controllers\AppointmentsController::class, 'delete'])->name('doctors.appointments.delete');
