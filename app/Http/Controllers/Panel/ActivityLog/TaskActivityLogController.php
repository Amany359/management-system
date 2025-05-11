<?php

namespace App\Http\Controllers\Panel\ActivityLog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskActivityLog;
use App\Events\TaskStatusChanged; // إضافة الـ Event
use App\Models\Task;
class TaskActivityLogController extends Controller
{
    



    // Amany359 عرض سجلات الأنشطة
   public function index(Request $request)
{
    $query = TaskActivityLog::with(['task', 'user'])->latest();

    // تصفية حسب الحالة القديمة أو الجديدة
    if ($request->has('status')) {
        $query->where('old_status', $request->status)
              ->orWhere('new_status', $request->status);
    }

    // تصفية حسب تاريخ التغيير
    if ($request->has('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $logs = $query->get();

    return view('panel.activity-log.index', compact('logs'));
}
 // الكود الخاص بتحديث حالة المهمة
    public function updateStatus(Request $request, Task $task)
    {
        $oldStatus = $task->status;
        $newStatus = $request->input('status');

        // تحديث حالة المهمة
        $task->status = $newStatus;
        $task->save();

        // إطلاق الحدث لتسجيل التغيير
        event(new TaskStatusChanged($task, $oldStatus, $newStatus, auth()->id(), $request->note));

        return redirect()->route('admin_manager.tasks.index')->with('status', 'تم تحديث الحالة');
    }
}