<?php

namespace App\Http\Controllers\Panel\QaManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardQaManagerController extends Controller
{
    public function dashboard()
    {
        // logic هنا
        return view('panel.qa_manager.dashboard');
    }
    
}
