<?php

namespace App\Http\Controllers\Panel\AdminManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminManagerController extends Controller
{
    public function index()
    {
        return view('panel.admin_manager.dashboard');
    }
}
