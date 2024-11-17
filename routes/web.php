<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/api/get_doctors', [App\Http\Controllers\DoctorsController::class, 'getDoctors'])->name('api.doctors.get_doctors');
Route::get('/api/{doctor_id}/get_time_slots', [App\Http\Controllers\AppointmentsController::class, 'getTimeSlots'])->name('api.doctors.appointments.get_time_slots');
Route::post('/api/{doctor_id}/new_time_slots', [App\Http\Controllers\AppointmentsController::class, 'newTimeSlots'])->name('api.doctors.appointments.new_time_slots');
Route::get('/api/{doctor_id}/get_my_appointments', [App\Http\Controllers\AppointmentsController::class, 'getMyAppointments'])->name('api.doctors.appointments.get_my_appointments');

Route::get('/aerzte/{doctor_id}/termine', [App\Http\Controllers\AppointmentsController::class, 'create'])->name('doctors.appointments.create');
Route::post('/aerzte/{doctor_id}/termine', [App\Http\Controllers\AppointmentsController::class, 'store'])->name('doctors.appointments.store');
Route::get('/aerzte/{doctor_id}/termine/{appointment_id}', [App\Http\Controllers\AppointmentsController::class, 'edit'])->name('doctors.appointments.edit');
Route::patch('/aerzte/{doctor_id}/termine/{appointment_id}', [App\Http\Controllers\AppointmentsController::class, 'update'])->name('doctors.appointments.update');
Route::delete('/aerzte/{doctor_id}/termine/{appointment_id}', [App\Http\Controllers\AppointmentsController::class, 'delete'])->name('doctors.appointments.delete');

Route::get('/{any}', [App\Http\Controllers\DoctorsController::class, 'index'])->name('doctors.index')->where('any', '.*');
