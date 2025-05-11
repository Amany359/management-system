<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id', 'old_status', 'new_status', 'changed_by', 'note',
    ];

    // علاقة مع جدول المهام
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    // علاقة مع جدول المستخدم (الذي قام بالتغيير)
    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
