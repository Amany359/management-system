<?php
namespace App\Services\QAManager;

use App\Models\Task;
use App\Models\TaskActivityLog;
class TaskQAManagerService
{
    // فلترة المهام
   public function filterTasks($request)
{
    return Task::when($request->status, fn($q) => $q->where('status', $request->status))
               ->when($request->tester_id, fn($q) => $q->where('tester_id', $request->tester_id))
               ->get();
}
    // اعتماد المهام
    public function approveTask($taskId)
{
    $task = Task::findOrFail($taskId);
    $oldStatus = $task->status;
$task->status = 'approved';
$task->save();

TaskActivityLog::create([
    'task_id' => $task->id,
    'changed_by' => auth()->id(),
    'old_status' => $oldStatus,
    'new_status' => 'approved',
    'note' => 'تم اعتماد المهمة',
]);
}

    // تعديل الجدولة
    public function rescheduleTask($request, $taskId)
    {
        $task = Task::find($taskId);
        $task->scheduled_for_date = $request->scheduled_for_date;
        $task->save();
    }
}
