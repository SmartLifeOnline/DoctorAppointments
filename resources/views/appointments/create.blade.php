@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Termineanfrage
                </div>
                <div class="card-body">
                    @if (count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id="app">
                        <new-date doctor-id="{{ $doctorId }}" :time-slots="{{ json_encode($timeSlots) }}"></new-date>
                        {{--<br>
                        <calendar-appointments></calendar-appointments>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
