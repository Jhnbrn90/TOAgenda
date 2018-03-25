@extends('admin.master')

@section('content')

<div class="container">
    <h2 style="color: darkred">{{ ucfirst($appointment->type) }}</h2>

    <br>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <strong> {{ $appointment->title }} </strong>
        </div>
    {{ $appointment->period }}<sup>e</sup> uur, {{ $appointment->formatted_date }} <br>
    </div>

    <div class="panel-body">
        {{ $appointment->body }}
    </div>

    <div class="panel-footer">
        <strong>Docent:</strong> {{ $appointment->creator->name }},
        <strong>klas:</strong> {{ $appointment->class }},
        <strong>locatie:</strong> {{ $appointment->location }}
    </div>
</div>



</div>

@endsection