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

        // get appointments from database
        $appointments = Appointment::all()
            ->groupBy('date')
            ->map(function($appt) { return $appt->groupBy('period'); });

//        dd(array_key_exists("06-02-2018", $appointments->toArray()));

        return view('appointment.index', compact('periods', 'weekdays', 'today', 'appointments'));
    }
}
