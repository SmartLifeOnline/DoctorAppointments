@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Ärzte
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($appointment_successfully_requested)
                        <div class="row">
                            <div class="col-md-12 alert alert-success">
                                <h1>Terminanfrage erfolgreich</h1>
                                <p>Hallo {{ $appointment_successfully_requested->patient_name }}.</p>
                                <p>
                                    Sie haben erfolgreich einen Termin von
                                    {{ $appointment_successfully_requested->timeSlot->start_time->format('d.m.Y H:i') }}
                                    bis {{ $appointment_successfully_requested->timeSlot->end_time->format('d.m.Y H:i') }}
                                    bei {{ $appointment_successfully_requested->doctor->name }} angefragt.</p>
                            </div>
                        </div>
                    @endif
                    <div id="app">
                        <doctors-list :doctors="{{ json_encode($doctors) }}"></doctors-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
