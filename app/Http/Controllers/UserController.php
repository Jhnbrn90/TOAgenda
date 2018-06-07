<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(7);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required',
            'email'     => 'required'
        ]);

        if ($request->password) {
            $user->update([
            'password' => bcrypt($request->password)
            ]);
        }

        $user->update([
            'name'  => $validated['username'],
            'email' => $validated['email']
        ]);

        session()->flash('message', ['success', 'Gebruiker bijgewerkt.']);

        return redirect('admin/users');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required'
        ]);

        User::create([
            'name'      => $validated['username'],
            'email'     => $validated['email'],
            'password'  => bcrypt($validated['password'])
        ]);

        session()->flash('message', ['success', 'Gebruiker toevoegd.']);

        return redirect('/admin/users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('message', ['success', 'Gebruiker verwijderd.']);

        return redirect()->route('users.index');
    }
}
