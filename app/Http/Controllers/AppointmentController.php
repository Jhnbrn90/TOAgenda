<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\WeekdaysCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Config;

class AppointmentController extends Controller
{

    public function index(string $date = 'now')
    {
        $periods = Config::getPeriods();
        $week = new WeekdaysCollection();

        $weekdays = $week->array();
        $today = $week->today();

        $emptyArray = $week->emptyAppointmentsArray();

        $appointments = Appointment::orderBy('date', 'ASC')
            ->get()
            ->groupBy('date')
            ->map(function($appt) { return $appt->groupBy('period'); });
        
        return view('appointment.index', compact('periods', 'weekdays', 'today', 'appointments'));
    }

    public function getAppointments(string $date = 'now')
    {
        $week = new WeekdaysCollection();

        $weekdays = $week->array();
        $today = $week->today();

        $emptyArray = $week->emptyAppointmentsArray();

        $appointments = Appointment::orderBy('date', 'ASC')
            ->get()
            ->groupBy('date')
            ->map(function($appt) { return $appt->groupBy('period'); });

        $appointments = array_replace_recursive($emptyArray, $appointments->toArray());

        return $appointments;
    }

    public function store(Request $request) 
    {
        $request->validate([
            'title'     => 'required',
            'body'      => 'required',
            'date'      => 'required',
            'period'    => 'required',
        ]);

        $appointment = Appointment::create([
            'user_id'   => auth()->id(),
            'title'     => $request->title,
            'body'      => $request->body,
            'date'      => $request->date,
            'period'    => $request->period,
        ]);

        return $appointment;
    }
}
