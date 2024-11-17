<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DoctorsController extends Controller
{
    /*public function index()
    {
        $doctors = Doctor::getDoctorsListArray();

        $appointment_id_successfully_requested = Session::get('appointment_id_successfully_requested', 0);
        Session::forget('appointment_successfully_requested');

        $appointment_successfully_requested = ($appointment_id_successfully_requested) ? Appointment::findActive($appointment_id_successfully_requested) : null;

        return view('doctors.index', compact('doctors', 'appointment_successfully_requested'));
    }*/

    public function index()
    {
        return view('index');
    }

    public function getDoctors()
    {
        return Doctor::getDoctorsListArray();
    }
}
