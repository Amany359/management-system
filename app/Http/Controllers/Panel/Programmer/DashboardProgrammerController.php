<?php

namespace App\Http\Controllers\Panel\Programmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardProgrammerController extends Controller
{
    public function index()
    {
        return view('panel.programmer.dashboard');
    }



}
