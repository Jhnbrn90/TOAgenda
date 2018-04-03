@extends('admin.master') 
@section('content')

<div class="container">
    @include ('layouts.flash')

    <div>
        <ol class="breadcrumb">
            <li><a href="/admin">Homepage</a></li>
            <li class="active">Alle afspraken</li>
        </ol>
    </div>

    <h2>Alle afspraken ({{ $appointments->total() }})</h2>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Datum</th>
                <th>Lesuur</th>
                <th>Titel</th>
                <th>Docent</th>
                <th>Klas</th>
                <th>Status</th>
                <th>Aangevraagd</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->date }}</td>
                <td>{{ $appointment->period }}</td>
                <td>{{ $appointment->title }}</td>
                <td>{{ $appointment->creator->name }}</td>
                <td>{{ $appointment->class }}</td>
                <td><a href="/admin/appointment/{{ $appointment->id }}">
                    @switch($appointment->accepted) @case(2)
                    <button class="btn btn-warning">Geweigerd</button> @break @case(1)
                    <button class="btn btn-success">Geaccepteerd</button> @break @default
                    <button class="btn btn-info">Open</button> @endswitch
                </a>
                </td>

                <td>{{ $appointment->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $appointments->links() }}
</div>
@endsection