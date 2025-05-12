<?php

namespace App\Services\Programmer;

use App\Models\User;
use App\Models\Task;

class TaskProgrammerService
{
    public function getTasksForUser()
{
    $user = auth()->user();
    $activeRole = session('active_role');

    if ($activeRole === 'programmer') {
        return Task::where('programmer_id', $user->id)->get();
    } elseif ($activeRole === 'tester') {
        return Task::where('tester_id', $user->id)->get();
    } else {
        // إعادة توجيه مع رسالة
        session()->flash('error', 'لا تملك صلاحية لعرض المهام.');
        return collect(); // إرجاع مجموعة فارغة لتفادي أخطاء العرض
    }
}

    public function updateStatus(Task $task, string $newStatus, User $user, string $role)
{
    $currentStatus = $task->status;

    $allowedTransitions = [
        'programmer' => [
            'approved' => ['in_progress'],
            'in_progress' => ['done'],
            'needs_fix' => ['in_progress'],
        ],
        'tester' => [
            'done' => ['in_testing'],
            'in_testing' => ['tested_done', 'needs_fix'],
        ]
    ];

    if ($role === 'programmer' && $task->programmer_id !== $user->id) {
        abort(403, 'Unauthorized programmer access.');
    }

    if ($role === 'tester' && $task->tester_id !== $user->id) {
        abort(403, 'Unauthorized tester access.');
    }

    if (!isset($allowedTransitions[$role][$currentStatus]) || 
        !in_array($newStatus, $allowedTransitions[$role][$currentStatus])) {
        abort(403, 'Invalid status transition.');
    }

    $task->status = $newStatus;
    $task->save();

    // ✅ سجل النشاط
    $task->taskActivityLogs()->create([
        'changed_by' => $user->id,
        'old_status' => $currentStatus,
        'new_status' => $newStatus,
        'note' => "تم تغيير الحالة بواسطة {$role} من {$currentStatus} إلى {$newStatus}",
    ]);

    return $this->getStatusMessage($newStatus);
}

protected function getStatusMessage(string $status): string
{
    return match ($status) {
        'in_progress' => 'تم بدء العمل على المهمة.',
        'done' => 'تم إنهاء المهمة بنجاح.',
        'needs_fix' => 'تم إرسال المهمة للتعديل.',
        'in_testing' => 'بدأت مرحلة اختبار المهمة.',
        'tested_done' => 'تمت الموافقة على المهمة بعد الاختبار.',
        default => 'تم تحديث الحالة.',
    };

}
}