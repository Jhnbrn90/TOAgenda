<?php

namespace App\Http\Controllers;

use App\Appointment;

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
}
