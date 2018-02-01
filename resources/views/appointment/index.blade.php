@extends('layouts.master')

@section('content')
<div class="container">
    <div class="grid-container">

        @foreach ($weekdays as $weekday)

            <weekday
                day="{{ $weekday->name }}"
                date="{{ $weekday->date }}"

                @if ($weekday->isPast())
                    class="past"
                @elseif ($weekday->isToday())
                    class="today"
                @endif
            >

                @for ($period = 1; $period <= $periods; $period++)
                    <lesson-period time="{{ $period }}">
                        @if (! $weekday->isPast())
                            <a href="#">Inplannen</a>
                        @endif
                    </lesson-period>
                @endfor

            </weekday>

        @endforeach

    </div>

</div>
@endsection
