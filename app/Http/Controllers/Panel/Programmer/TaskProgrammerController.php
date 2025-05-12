<?php

namespace App\Http\Controllers\Panel\Programmer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Programmer\UpdatTaskProgrammerStatusRequest;
use App\Services\Programmer\TaskProgrammerService;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
class TaskProgrammerController extends Controller
{
    public function __construct(protected TaskProgrammerService $taskService) {}

    public function index()
{
    $tasks = $this->taskService->getTasksForUser(auth()->id());
    
    // تحقق إذا كانت المهام فارغة
    if ($tasks->isEmpty()) {
        return view('panel.programmer.tasks.index', ['tasks' => $tasks, 'message' => 'لا توجد مهام حالياً.']);
    }

    return view('panel.programmer.tasks.index', compact('tasks'));
}

public function updateStatus(UpdatTaskProgrammerStatusRequest $request, $taskId)
{
    $task = Task::findOrFail($taskId);
    $user = auth()->user();
    $role = session('active_role');
    $newStatus = $request->input('status');

    $message = $this->taskService->updateStatus($task, $newStatus, $user, $role);

    return redirect()->back()->with('status_message', $message);
}

}