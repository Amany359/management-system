<?php

namespace App\Http\Controllers\Panel\TeamLeader;
use App\Services\TeamLeader\TaskService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
class DashboardController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
 
    public function index()
    {
        $tasks = Task::where('team_leader_id', auth()->id())->get();
        return view('panel.team-leader.dashboard', compact('tasks'));
    }
}
