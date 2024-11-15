<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AppointmentsController extends Controller
{

    public function index(int $appointmentId)
    {
        $appointmentsArray = Appointment::getRequestSuccessfulArray($appointmentId);

        return view('appointments.index', compact('appointmentsArray'));
    }

    public function create(int $doctorId)
    {
        $timeSlots = TimeSlot::getNewDateArray($doctorId);

        return view('appointments.create', compact('doctorId', 'timeSlots'));
    }

    public function store(int $doctorId, Request $request)
    {
        $rules = [
            'time_slot_id' => 'required|numeric|min:1',
            'patient_email' => 'email:rfc,dns',
            'vorname' => 'required',
            'nachname' => 'required'
        ];

        $errorMessages = [
            'time_slot_id.required' => 'Bitte wählen Sie einen Termin aus.',
            'patient_email' => 'Bitte geben Sie Ihre E-Mail-Adresse ein.',
            'vorname.required' => 'Bitte geben Sie Ihren Vornamen ein.',
            'nachname.required' => 'Bitte geben Sie Ihren Nachnamen ein.'
        ];

        $validator = Validator::make($request->all(), $rules, $errorMessages);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $doctor = Doctor::findActive($doctorId);

        if(!$doctor) {
            return response()->json(['error' => 'doctor_not_found'], 400);
        }

        $timeSlot = TimeSlot::findActiveAndAvailable($request->time_slot_id);

        if(!$timeSlot) {
            return response()->json(['error' => 'no_time_slot_not_available'], 400);
        }

        $appointment = new Appointment();

        $appointment->doctor_id = $doctorId;
        $appointment->patient_name = $request->vorname . ' ' . $request->nachname;
        $appointment->patient_email = $request->patient_email;
        $appointment->date_time = $timeSlot->start_time;
        $appointment->time_slot_id = $timeSlot->id;

        $appointment->save();

        $timeSlot->appointment_id = $appointment->id;
        $timeSlot->is_available = 0;

        $timeSlot->update();

        Session::put('appointment_id_successfully_requested', 1);

        return response()->json($appointment);
    }

    public function edit(int $doctorId, int $appointmentId)
    {
        $appointment = Appointment::getActive();
        $timeSlots = TimeSlot::getNewDateArray($doctorId);

        return view('appointments.create', compact('doctorId', 'appointment', 'timeSlots'));
    }

    public function update(int $doctorId, int $appointmentId, Request $request)
    {
        $rules = [
            'time_slot_id' => 'required|numeric|min:1',
            'patient_email' => 'email:rfc,dns',
            'vorname' => 'required',
            'nachname' => 'required'
        ];

        $errorMessages = [
            'time_slot_id.required' => 'Bitte wählen Sie einen Termin aus.',
            'patient_email' => 'Bitte geben Sie Ihre E-Mail-Adresse ein.',
            'vorname.required' => 'Bitte geben Sie Ihren Vornamen ein.',
            'nachname.required' => 'Bitte geben Sie Ihren Nachnamen ein.'
        ];

        $validator = Validator::make($request->all(), $rules, $errorMessages);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $appointment = Appointment::findActive($appointmentId);

        if(!$appointment) {
            return response()->json(['error' => 'appointment_not_found'], 400);
        }

        $doctor = Doctor::findActive($doctorId);

        if(!$doctor || $doctorId !== $appointment->doctor_id) {
            return response()->json(['error' => 'doctor_not_found'], 400);
        }

        if($appointment->time_slot_id != $request->time_slot_id) {
            $timeSlot = TimeSlot::findActiveAndAvailable($request->time_slot_id);

            if(!$timeSlot) {
                return response()->json(['error' => 'no_time_slot_not_available'], 400);
            }

            $appointment->timeSlot->appointment_id = $appointment->id;
            $appointment->timeSlot->is_available = 0;

            $appointment->timeSlot->update();
        }

        $appointment->doctor_id = $doctorId;
        $appointment->patient_name = $request->vorname . ' ' . $request->nachname;
        $appointment->patient_email = $request->patient_email;
        $appointment->date_time = $timeSlot->start_time;
        $appointment->time_slot_id = $timeSlot->id;

        $appointment->update();

        $timeSlot->appointment_id = $appointment->id;
        $timeSlot->is_available = 0;

        $timeSlot->update();

        Session::put('appointment_id_successfully_requested', 1);

        return response()->json($appointment);
    }

    public function delete(int $doctorId, int $appointmentId)
    {
        $appointment = Appointment::findActive($appointmentId);

        if(!$appointment) {
            return response()->json(['error' => 'appointment_not_found'], 400);
        }

        $doctor = Doctor::findActive($doctorId);

        if(!$doctor || $doctorId !== $appointment->doctor_id) {
            return response()->json(['error' => 'doctor_not_found'], 400);
        }

        $appointment->active = 0;
        $appointment->update();

        $appointment->timeSlot->appointment_id = null;
        $appointment->timeSlot->is_available = 1;

        $appointment->timeSlot->update();

        return response()->json($appointment);
    }

}
