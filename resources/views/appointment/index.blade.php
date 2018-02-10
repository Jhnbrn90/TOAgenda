@extends('layouts.master')

@section('content')
<div class="container">

<center>
<button class="btn btn-default" @click="switchDate(moment(Object.keys(days)[0], 'DD-MM-YYYY').subtract(7, 'd').format('DD-MM-YYYY'))"> << Vorige </button>
<button class="btn btn-link" @click="switchDate('now')"> Huidige </button>
<button class="btn btn-default" @click="switchDate(moment(Object.keys(days)[0], 'DD-MM-YYYY').add(7, 'd').format('DD-MM-YYYY'))"> Volgende >> </button>
</center>

    <div class="grid-container">
        <appt v-for="(weekday, day) in appointments">
        <transition name="slide-fade">
            <weekday v-if="days[day]" :date="day" :day="days[day].name" :class="days[day].past ? 'past' : days[day].today ? 'today' : '' ">
                <lesson-period v-for="(period, index) in weekday" :time="index" :date="day" @set-date="setAppointment" >
                    <appointment v-for="appointment in period" :title="appointment.title" :body="appointment.body"></appointment>
                </lesson-period>
            </weekday>
        </transition>
        </appt>
    </div>
</div>

<div class="container">
    <appointment-modal  :day="modalday" :period="modalperiod" @new-appointment="onNewAppointment"></appointment-modal>
</div>

@endsection
