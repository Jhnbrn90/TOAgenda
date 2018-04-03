@extends('admin.master') 
@section('content')

<div class="container">
    @include ('layouts.flash')

    <div>
        <ol class="breadcrumb">
            <li><a href="/admin">Homepage</a></li>
            <li class="active">Nieuwe afspraken</li>
        </ol>
    </div>

    <h2>Nieuwe afspraken ({{ $appointments->total() }})</h2>
    <ul>
        @foreach($appointments as $appointment)
        <li>
            <a href="/admin/appointment/{{ $appointment->id }}">{{ $appointment->title }} ({{ $appointment->date }})</a>
        </li>
        @endforeach
    </ul>
    {{ $appointments->links() }}
</div>
@endsection