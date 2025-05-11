<?php

namespace App\Http\Controllers\Panel\QAManager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\QAManager\TaskQAManagerService;
use App\Http\Requests\Panel\QAManager\TaskFilterRequest;
use Illuminate\Http\Request;

class TaskQAManagerController extends Controller
{
    protected $taskQAManagerService;

    public function __construct(TaskQAManagerService $taskQAManagerService)
    {
        $this->taskQAManagerService = $taskQAManagerService;
    }

    // عرض المهام
    public function index(TaskFilterRequest $request)
{
    // فلترة المهام
    $tasks = $this->taskQAManagerService->filterTasks($request);

    // جلب المستخدمين
    $users = \App\Models\User::all();

    return view('panel.qa_manager.tasks.index', compact('tasks', 'users'));
}
    // اعتماد المهام
    public function approveTask($taskId)
    {
        $this->taskQAManagerService->approveTask($taskId);
        return redirect()->route('qa_manager.tasks.index')->with('success', 'تم اعتماد المهمة بنجاح');
    }

    // تعديل الجدولة
    public function rescheduleTask(Request $request, $taskId)
    {
        $this->taskQAManagerService->rescheduleTask($request, $taskId);
        return redirect()->route('qa_manager.tasks.index')->with('success', 'تم تعديل الجدولة بنجاح');
    }
}
