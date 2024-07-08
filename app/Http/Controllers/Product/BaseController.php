<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Service\Product\ProductService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }
}
