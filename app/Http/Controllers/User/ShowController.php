<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        return response()->json([
            'data' => $user
        ], 200);
    }
}
