<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('accepted', 0)->orderBy('id', 'DESC')->get();

        return view('admin.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        return view('admin.show', compact('appointment'));
    }

    public function update(Appointment $appointment, Request $request)
    {
        $message = $request->message;

        switch ($request->submit_type) {
            case 'accept':
                $appointment->accept($message);
                // event dispatchen dat de afspraak is geaccepteerd
                return redirect('/admin');
            break;

            case 'deny':
                $appointment->deny($message);
                // event dispatchen dat de afspraak is geweigerd
                return redirect('/admin');
            break;
        }
    }
}
