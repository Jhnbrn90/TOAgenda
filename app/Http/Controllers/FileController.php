<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $path = $request->file('attachment')->store('uploads');

        $tmp_filename = preg_split('#/#', $path)[1];
        $original_filename = $request->file('attachment')->getClientOriginalName();

        $json_response = $tmp_filename . ';' . $original_filename;

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
