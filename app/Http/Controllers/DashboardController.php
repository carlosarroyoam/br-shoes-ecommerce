<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
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
