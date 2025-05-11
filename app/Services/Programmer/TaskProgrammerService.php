<?php

// app/Services/Programmer/TaskProgrammerService.php

namespace App\Services\Programmer;
use App\Models\User;
use App\Models\Task;

class TaskProgrammerService
{
    public function getTasksForUser($userId)
    {
       $user = auth()->user();
    $activeRole = session('active_role');

   if ($activeRole === 'programmer') {
    $tasks = Task::where('programmer_id', $user->id)->get();
} elseif ($activeRole === 'tester') {
    $tasks = Task::where('tester_id', $user->id)->get();
} else {
    abort(403, 'Access denied.');
}

    return $tasks; // ✅ أضف هذا السطر
}

  public function updateStatus($taskId, $status)
    {
        $task = Task::findOrFail($taskId);

        // تحقق من الدور
         if ($task->programmer_id !== auth()->id() && $task->tester_id !== auth()->id()) {
        abort(403);
    }

        // تحديث الحالة بناءً على المدخلات
        $task->status = $status;
        $task->save();
    }
}