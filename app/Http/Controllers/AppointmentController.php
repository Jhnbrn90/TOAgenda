<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\WeekdaysCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Config;

class AppointmentController extends Controller
{

    public function index()
    {
        $periods = Config::getPeriods();

        return view('appointment.index', compact('periods'));
    }

    public function getAppointments(Request $request)
    {
        $date = $request->date ?: 'now';

        $week = new WeekdaysCollection($date);
        $emptyArray = $week->emptyAppointmentsArray();

        $appointments =
            Appointment::
            Week($date)
                ->orderBy('date', 'ASC')
                ->get()
                ->groupBy('date')
                ->map(function($appt) { return $appt->groupBy('period'); });

        $appointments = array_replace_recursive($emptyArray, $appointments->toArray());

        return array_slice($appointments, 0, 5, true);
    }

    public function getWeekdays(Request $request)
    {
        $date = $request->date ? : 'now';

        $week = new WeekdaysCollection($date);

        return $week->json();
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
            'user_id'       => auth()->id(),
            'title'         => $request->title,
            'body'          => $request->body,
            'date'          => $request->date,
            'timestamp'     => Carbon::parse($request->date),
            'period'        => $request->period,
        ]);

        return $appointment;
    }
}
