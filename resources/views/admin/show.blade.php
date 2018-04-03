@extends('admin.master') 
@section('content')

<div class="container">
    <h2 style="color: darkred">{{ ucfirst($appointment->type) }}</h2>

    <br>

    <div class="panel panel-default admin-panel">
        <div class="panel-heading">
            <div class="panel-title" style="margin-top: -20px;">
                <h3> {{ $appointment->title }} </h3>
            </div>
            <h4>{{ $appointment->period }}<sup>e</sup> uur, {{ $appointment->formatted_date }} </h4>
        </div>

        <div class="panel-body">
            <p>{{ $appointment->body }}</p>
        </div>

        <div class="panel-footer">
            <strong>Docent:</strong> {{ $appointment->creator->name }},
            <strong>klas:</strong> {{ $appointment->class }},
            <strong>locatie:</strong> {{ $appointment->location }}
        </div>
    </div>

    <div class="panel panel-default admin-message">
        <div class="panel-body">
            <h3 style="margin-top:5px;">Bericht:</h3>

            <form action="/admin/appointment/{{ $appointment->id }}" method="POST" autocomplete="off">
                {{ csrf_field() }} {{ method_field('patch') }}

                <div class="form-group">
                    <textarea name="message" class="form-control" rows="5" autofocus></textarea>
                </div>

                <center>
                    <div class="form-group">
                        <button type="submit" name="submit_type" value="accept" class="btn btn-success btn-lg">Accepteren</button>
                        <button type="submit" name="submit_type" value="deny" class="btn btn-danger btn-lg">Weigeren</button>
                    </div>
                </center>

            </form>
        </div>
    </div>
</div>
@endsection