@extends('layouts.master')

@section('content')

<div class="container">
    <div class="grid-container">

        @foreach ($weekdays as $day => $date)
            <weekday 
            day="{{ $day }}"
            date="{{ $date }}"
            @if ($day === $today)
            today="1"
            @endif>
                @for ($period = 1; $period <= $totalPeriods; $period++)
                    <lesson-period time="{{ $period }}"></lesson-period>        
                @endfor

            </weekday> 
        @endforeach

    </div>

</div>


@endsection