<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index(Request $request): View
    {
        return view('admin.index');
    }
}
