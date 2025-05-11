<?php
namespace App\Services\AdminManager;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TaskAdminManagerService
{
    public function index(): View
    {
       // $tasks = Task::with('assignedTo')->latest()->get();
           $tasks = Task::with(['programmer', 'tester', 'teamLeader'])->latest()->get();

        return view('panel.admin_manager.tasks.index', compact('tasks'));
    }

    //public function performance(): View
   // {
    //    $users = User::withCount(['tasks as completed_tasks_count' => function ($q) {
     //       $q->where('status', 'completed');
     //   }])->get();

      //  return view('panel.admin_manager.tasks.performance', compact('users'));
   // }

 
        
    public function performance(): View
    {
       $users = User::withCount([
    'tasksAsProgrammer as completed_programmer_tasks' => fn($q) => $q->where('status', 'completed'),
    'tasksAsTester as completed_tester_tasks' => fn($q) => $q->where('status', 'completed'),
    'tasksAsTeamLeader as completed_leader_tasks' => fn($q) => $q->where('status', 'completed'),
])->get();

        return view('panel.admin_manager.tasks.performance', compact('users'));
    }

    public function updatePriority($request, $id): RedirectResponse
    {
        $task = Task::findOrFail($id);
        $task->priority = $request->priority;
        $task->save();

        return redirect()->back()->with('success', 'تم تحديث الأولوية بنجاح');
    }

    public function weeklyReport(): View
    {
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();

        $tasks = Task::whereBetween('updated_at', [$start, $end])
                     ->where('status', 'completed')
                     ->with('assignedTo')
                     ->get();

        return view('panel.admin_manager.tasks.weekly_report', compact('tasks', 'start', 'end'));
    }
}
