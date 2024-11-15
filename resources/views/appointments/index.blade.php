@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 alert alert-success">
                <h1>Erfolgreich</h1>
                <p>Hallo {{ $appointment->patient_name }}.</p>
                <p>
                    Sie haben erfolgreich einen Termin von
                    {{ $timeSlot->start_time->format('d.m.Y H:i') }} bis {{ $timeSlot->end_time->format('d.m.Y H:i') }}
                    bei {{ $doctor->name }} angefragt.</p>
            </div>
        </div>
    </div>
@endsection
