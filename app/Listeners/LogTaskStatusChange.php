<?php

namespace App\Listeners;

use App\Events\TaskStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\TaskActivityLog;
class LogTaskStatusChange
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskStatusChanged $event): void
    {
        // تسجيل التغيير في جدول سجل الأنشطة
        TaskActivityLog::create([
            'task_id' => $event->task->id,
            'old_status' => $event->oldStatus,
            'new_status' => $event->newStatus,
            'changed_by' => $event->changedBy,
            'note' => $event->note,
        ]);
    }
    
}
