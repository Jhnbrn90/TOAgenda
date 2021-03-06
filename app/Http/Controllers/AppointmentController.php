<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\WeekdaysCollection;
use Illuminate\Http\Request;
use App\Config;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $periods = Config::getPeriods();

        return view('appointment.index', compact('periods'));
    }

    public function getAppointments($date)
    {
        $date = $date ?: 'now';

        $week = new WeekdaysCollection($date);
        $emptyArray = $week->emptyAppointmentsArray();

        $appointments = Appointment::active()->Week($date)
                ->orderBy('date', 'ASC')
                ->orderBy('id', 'ASC')
                ->get()
                ->groupBy('date')
                ->map(function ($appt) { return $appt->groupBy('period'); });

        $appointments = array_replace_recursive($emptyArray, $appointments->toArray());

        return array_slice($appointments, 0, 5, true);
    }

    public function getFilteredAppointments($date)
    {
        $date = $date ?: 'now';

        $week = new WeekdaysCollection($date);
        $emptyArray = $week->emptyAppointmentsArray();

        $appointments = Appointment::active()->Week($date)
            ->where('user_id', auth()->id())
            ->orderBy('date', 'ASC')
            ->orderBy('id', 'ASC')
            ->get()
            ->groupBy('date')
            ->map(function ($appt) {
                return $appt->groupBy('period');
            });

        $appointments = array_replace_recursive($emptyArray, $appointments->toArray());

        return $appointments;

        // return array_slice($appointments, 0, 5, true);
    }

    public function getWeekdays($date)
    {
        $date = $date ?: 'now';

        $week = new WeekdaysCollection($date);

        return $week->json();
    }

    public function store(Request $request)
    {
        $attachments = null;

        // check if anything was uploaded
        if (!empty($request->attachments)) {
            $attachments = json_encode($request->attachments);
        }

        $request->validate([
            'title'    => 'required',
            'body'     => 'required',
            'date'     => 'required',
            'class'    => 'required',
            'subject'  => 'required',
            'location' => 'required',
            'type'     => 'required',
            'period'   => 'required',
        ]);

        $appointment = Appointment::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'body'        => $request->body,
            'date'        => $request->date,
            'period'      => $request->period,
            'class'       => $request->class,
            'subject'     => $request->subject,
            'type'        => $request->type,
            'location'    => $request->location,
            'attachments' => $attachments,
        ]);

        return $appointment;
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        // if ($appointment->user_id != auth()->id()) {
        //     abort(403, 'U heeft geen toegang.');
        // }

        $appointment->delete();

        return response([], 204);
    }
}
