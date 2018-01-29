@extends('layouts.master')

@section('content')

<div class="container">
    <div class="grid-container">

        @foreach ($weekdays as $weekday)
            <weekday 
            day="{{ $weekday['day'] }}" 
            date="{{ $weekday['date'] }}">

                @for ($period = 1; $period <= $totalPeriods; $period++)
                    <lesson-period time="{{ $period }}"></lesson-period>        
                @endfor

            </weekday> 
        @endforeach

    </div>

</div>


@endsection