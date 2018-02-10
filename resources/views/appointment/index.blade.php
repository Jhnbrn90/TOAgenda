@extends('layouts.master')

@section('content')
<div class="container">

<center>
    <nav-buttons :date="Object.keys(days)[0]" @nav-to-date="switchDate"></nav-buttons>
</center>  

    <div class="grid-container">
        <appt v-for="(weekday, day) in appointments" v-bind:key="day">
        <transition name="slide-fade">
            <weekday v-if="days[day]" :date="day" :day="days[day].name" :class="days[day].past ? 'past' : days[day].today ? 'today' : '' ">
                
                <lesson-period v-for="(period, index) in weekday" v-bind:key="day + '-' + index" :time="index" :date="day" @set-date="setAppointment" >
                
                    <appointment v-for="appointment in period" v-bind:key="appointment.id" :title="appointment.title" :body="appointment.body"></appointment>
                
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
