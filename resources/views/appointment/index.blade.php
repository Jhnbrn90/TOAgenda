@extends('layouts.master')

@section('content')
<div class="container">
    <div class="grid-container">

        @foreach ($weekdays as $weekday)

            <weekday
                day="{{ $weekday->name }}"
                date="{{ $weekday->day_month }}"

                @if ($weekday->isPast())
                    class="past"
                @elseif ($weekday->isToday())
                    class="today"
                @endif
            >

                @for ($period = 1; $period <= $periods; $period++)
                    <lesson-period time="{{ $period }}">

                        @if (array_key_exists($weekday->date_string, $appointments->toArray())
                        && array_key_exists($period, $appointments[$weekday->date_string]->toArray()))

                            @foreach ($appointments[$weekday->date_string][$period] as $appointment)

                                <appointment
                                title="{{ $appointment->title }}"
                                body="{{ $appointment->body }}"
                                ></appointment>

                            @endforeach

                        @else

                            <p>Beschikbaar</p>

                        @endif

                            {{--<div v-show="newAppointment && (this.period == {{ $period }})">--}}
                                {{--<div class="new-appointment"> <appointment :title="title" :body="body"></appointment> </div>--}}
                            {{--</div>--}}

                        @if (! $weekday->isPast())

                            <button class="btn btn-link"
                                @click.prevent="setAppointment('{{ $weekday->date_string }}', '{{ $period }}')"
                                data-toggle="modal" data-target="#myModal">Inplannen</button>

                        @endif

                    </lesson-period>
                @endfor

            </weekday>

        @endforeach

    </div>

</div>

<div class="container">
    <appointment-modal :day="modalday" :period="modalperiod" @new-appointment="onNewAppointment"></appointment-modal>
</div>


{{--<div id="modal" v-bind:class="{ show : modalOpen }">--}}
    {{--<button v-on:click="modalOpen = false" class="modal-close">--}}
        {{--&times;--}}
    {{--</button>--}}

    {{--<div class="modal-content">--}}
        {{--<h1>Nieuwe aanvraag</h1>--}}
        {{--<br> @{{ day }}--}}
        {{--<br> @{{ period }}--}}
    {{--</div>--}}
{{--</div>--}}
@endsection