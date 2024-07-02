<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Service\Brand\BrandService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public BrandService $service;

    public function __construct(BrandService $service)
    {
        $this->service = $service;
    }
}
