<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @param Request $request
     */
    public function dashboard(Request $request)
    {
        return view('admin.dashboard');
    }

    /**
     * @param Request $request
     */
    public function posts(Request $request)
    {

    }
}
