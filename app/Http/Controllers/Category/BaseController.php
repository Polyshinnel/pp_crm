<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Service\Category\CategoryService;

class BaseController extends Controller
{
    public CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
