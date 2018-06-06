<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $storedAs = basename(
            $request->file('attachment')->store('uploads')
        );

        $originalFilename = $request->file('attachment')->getClientOriginalName();

        $json_response = $storedAs . ';' . $originalFilename;

        return response()->json($json_response);
    }

    public function fakeDestroy()
    {
        return '';
    }

    public function destroy($file)
    {
        Storage::delete('uploads/' . $file);
    }
}
