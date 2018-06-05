<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
        // TODO: extract a method
        $path = $request->file('attachment')->store('uploads');
        $tmp_filename = preg_split('#/#', $path)[1];
        $tmp_filename = explode('.', $tmp_filename)[0];

        return response()->json($tmp_filename);
    }

    public function destroy(Request $request)
    {
        dd($request);
    }
}
