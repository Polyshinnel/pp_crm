<?php

namespace App\Http\Controllers\Param;

use App\Http\Controllers\Controller;
use App\Service\Params\ParamsService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public ParamsService $service;

    public function __construct(ParamsService $service)
    {
        $this->service = $service;
    }
}
