<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * @param Request $request
     * @param string $name
     */
    public function index(Request $request, string $name)
    {
        return route($name, $request->all());
    }
}
