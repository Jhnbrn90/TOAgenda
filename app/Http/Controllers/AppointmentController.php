<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;
use App\Weekdays;

class AppointmentController extends Controller
{

    public function index(string $date = 'now') 
    {
        $totalPeriods = Config::getPeriods();

        $weekdays = Weekdays::getDaysFor($date);
        
        return view('appointment.index', compact('totalPeriods', 'weekdays'));
    }
}
