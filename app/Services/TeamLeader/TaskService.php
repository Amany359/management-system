<?php
namespace App\Services\TeamLeader;
use App\Notifications\ProgrammerOrTesterAssignedNotification;

use App\Models\Task;

class TaskService



{
public function getAllTasksWithRelations()
{
    return Task::with(['programmer', 'tester'])->get();
}

    // استرجاع مهام الأسبوع الحالي
    public function getAllTasks()
{
    return Task::latest()->get();
}

    // إنشاء مهمة جديدة
    public function createTask(array $data)
    {


    // إجبار تعيين التاريخ تلقائيًا من السيرفر فقط
    $data['scheduled_for_date'] = now();
    $data['original_scheduled_date'] = $data['scheduled_for_date'];

    $task = Task::create($data); // احفظ المهمة في متغير

    // إرسال الإشعار للمبرمج إن وُجد
   // if ($task->programmer) {
      //  $task->programmer->notify(new ProgrammerOrTesterAssignedNotification($task));
    //}

    // إرسال الإشعار للمختبر إن وُجد
   // if ($task->tester) {
    //    $task->tester->notify(new ProgrammerOrTesterAssignedNotification($task));
    //}

    return $task;
    }
    // تحديث مهمة
    public function updateTask(Task $task, array $data)
    {
        return $task->update($data);
    }

    // تعيين تيستر
    public function assignTester(Task $task, $testerId)
    {
        $task->tester_id = $testerId;
        $task->save();


 $tester = $task->tester;
    if ($tester) {
        $tester->notify(new ProgrammerOrTesterAssignedNotification($task));
    }

    }

    // حذف مهمة
    public function deleteTask(Task $task)
    {
        $task->delete();
    }

    // استرجاع مهمة واحدة
    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }
   
}
