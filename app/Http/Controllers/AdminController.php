<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function indexAllAppointments()
    {
        session(['backTitle' => 'Alle afspraken', 'backUrl' => url()->current()]);
        $appointments = Appointment::orderBy('id', 'DESC')->paginate(6);
        return view('admin.appointments.all', compact('appointments'));
    }

    public function indexOpenAppointments()
    {
        session(['backTitle' => 'Nieuwe afspraken', 'backUrl' => url()->current()]);

        $appointments = Appointment::where('accepted', 0)->orderBy('id', 'DESC')->paginate(10);

        return view('admin.appointments.open', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }

    public function update(Appointment $appointment, Request $request)
    {
        $message = $request->message;

        switch ($request->submit_type) {
            case 'accept':
                $appointment->accept($message);
                // event dispatchen dat de afspraak is geaccepteerd
                session()->flash('message', ['success', 'Afspraak geaccepteerd.']);
                if (session('backUrl')) {
                    return redirect(session('backUrl'));
                }
                return redirect('/admin/appointments/open');
            break;

            case 'deny':
                $appointment->deny($message);
                session()->flash('message', ['success', 'Afspraak geweigerd.']);
                // event dispatchen dat de afspraak is geweigerd
                if (session('backUrl')) {
                    return redirect(session('backUrl'));
                }
                return redirect('/admin/appointments/open');
            break;
        }
    }
}
