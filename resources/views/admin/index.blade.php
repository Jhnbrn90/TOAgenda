@extends('admin.master')

@section('content')

<div class="container">
    <h2>Openstaande verzoeken</h2>
    <ul>
    @foreach($appointments as $appointment)
        <li>
            <a href="/admin/appointment/{{ $appointment->id }}">{{ $appointment->title }} ({{ $appointment->date }})</a>
        </li>
    @endforeach
    </ul>
</div>


@endsection