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
                    @endif></weekday>
        @endforeach
    </div>

    <div class="grid-container">
        <appt v-for="(weekday, day) in appointments">
            <lesson-period v-for="(period, index) in weekday" :time="index" :date="day" @set-date="setAppointment" >
                <appointment v-for="appointment in period" :title="appointment.title" :body="appointment.body"></appointment>
            </lesson-period>
        </appt>
    </div>
</div>

<div class="container">
    <appointment-modal  :day="modalday" :period="modalperiod" @new-appointment="onNewAppointment"></appointment-modal>
</div>

@endsection
