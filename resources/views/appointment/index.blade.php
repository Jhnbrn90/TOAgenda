@extends('layouts.master')

@section('content')
<div class="container">

    <div class="grid-container">
        <appt v-for="(weekday, day) in appointments">
            <weekday :date="day" :day="days[day].name" :class="days[day].past ? 'past' : days[day].today ? 'today' : '' ">
                <lesson-period v-for="(period, index) in weekday" :time="index" :date="day" @set-date="setAppointment" >
                    <appointment v-for="appointment in period" :title="appointment.title" :body="appointment.body"></appointment>
                </lesson-period>
            </weekday>
        </appt>
    </div>
</div>

<div class="container">
    <appointment-modal  :day="modalday" :period="modalperiod" @new-appointment="onNewAppointment"></appointment-modal>
</div>

@endsection
