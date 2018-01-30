<?php

namespace App\Http\Controllers;

use App\Weekdays;
use Illuminate\Http\Request;
use App\Config;
use App\WeekdaysOld;

class AppointmentController extends Controller
{

    public function index(string $date = 'now') 
    {
        $totalPeriods = Config::getPeriods();

        $weekdays = Weekdays::getWeekdaysFor($date);

        $today = Weekdays::getToday();

        return view('appointment.index', compact('totalPeriods', 'weekdays', 'today'));
    }
}
