<?php
namespace App\Http\Controllers\Panel\TeamLeader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\TeamLeader\StoreTaskRequest;
use App\Http\Requests\Panel\TeamLeader\UpdateTaskRequest;
use App\Models\User;
use App\Models\Task;
use App\Services\TeamLeader\TaskService;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    // عرض المهام حسب الأسبوع
    public function index()
{
    $tasks = $this->taskService->getAllTasksWithRelations();
    $users = User::where('role', 'tester')->get();
    return view('panel.team-leader.tasks.index', compact('tasks', 'users'));
}
    // عرض نموذج إضافة مهمة جديدة
    public function create()
    {
       
          $taskService = new TaskService();
    
       
        // $users = User::all(); // المبرمجين والتيسترات
        //return view('panel.team-leader.tasks.create', compact('users'));
        $programmers = User::where('role', 'programmer')->get();
    $testers = User::where('role', 'tester')->get();

    return view('panel.team-leader.tasks.create', compact('programmers', 'testers'));
}
   
    

    // تخزين المهمة الجديدة
    public function store(StoreTaskRequest $request)
    {
        $this->taskService->createTask($request->validated());
        return redirect()->route('team_leader.tasks.index')->with('success', 'Task created successfully.');
    }

    // عرض نموذج تعديل مهمة
    public function edit($id)
    {
        $task = $this->taskService->getTaskById($id);
        //$users = User::all();
        //return view('panel.team-leader.tasks.edit', compact('task', 'users'));
        $programmers = User::where('role', 'programmer')->get();
       $testers = User::where('role', 'tester')->get();
   



       return view('panel.team-leader.tasks.edit', compact('task', 'programmers', 'testers'));
    }
    
    

    // تحديث المهمة
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = $this->taskService->getTaskById($id);
        $this->taskService->updateTask($task, $request->validated());
        return redirect()->route('team_leader.tasks.index')->with('success', 'Task updated successfully.');
    }

    // تعيين تيستر للمهمة
    public function assignTester($taskId, Request $request)
    {
        $task = $this->taskService->getTaskById($taskId);
        $this->taskService->assignTester($task, $request->tester_id);
        return redirect()->route('team_leader.tasks.index')->with('success', 'Tester assigned successfully.');
    }

    // حذف المهمة
    public function destroy($id)
    {
        $task = $this->taskService->getTaskById($id);
        $this->taskService->deleteTask($task);
        return redirect()->route('team_leader.tasks.index')->with('success', 'Task deleted successfully.');
    }
    
}
