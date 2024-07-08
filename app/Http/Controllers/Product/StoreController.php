<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request) {
        $data = $request->validated();
        $result = $this->service->store($data);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }
}
