<?php

namespace App\Http\Controllers\Panel\TeamLeader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    

public function index()
    {
        return view('panel.team-leader.dashboard');
    }



}
