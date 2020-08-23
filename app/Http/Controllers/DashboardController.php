<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.admin-only');
    }

    /**
     * Shows the admin dashboard.
     *
     * @return View
     */
    public function index()
    {
        return view('pages.admin.index');
    }
}
