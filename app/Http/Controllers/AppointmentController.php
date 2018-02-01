<?php

namespace App\Http\Controllers;

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

        return view('appointment.index', compact('periods', 'weekdays', 'today'));
    }
}
