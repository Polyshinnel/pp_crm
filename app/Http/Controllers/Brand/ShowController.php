<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Brand $brand) {
        $result = $brand->toArray();
        return response()->json($result, 200);
    }
}
