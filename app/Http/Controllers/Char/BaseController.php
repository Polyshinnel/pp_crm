<?php

namespace App\Http\Controllers\Char;

use App\Http\Controllers\Controller;
use App\Service\Chars\CharsService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public CharsService $service;

    public function __construct(CharsService $service)
    {
        $this->service = $service;
    }
}
