<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UploadController extends Controller
{
    public function __invoke(Request $request) {
        $path = $request->file('image')->store('uploads', 'public');
        $path = '/storage/'.$path;
        return response()->json([
            'path' => $path
        ]);
    }
}
