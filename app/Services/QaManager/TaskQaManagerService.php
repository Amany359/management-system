<?php
namespace App\Services\QAManager;

use App\Models\Task;

class TaskQAManagerService
{
    // فلترة المهام
    public function filterTasks($request)
    {
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        return $query->get();
    }

    // اعتماد المهام
    public function approveTask($taskId)
    {
        $task = Task::find($taskId);
        $task->status = 'Approved'; // اعتمدنا المهمة
        $task->save();
    }

    // تعديل الجدولة
    public function rescheduleTask($request, $taskId)
    {
        $task = Task::find($taskId);
        $task->scheduled_for = $request->scheduled_for;
        $task->save();
    }
}
