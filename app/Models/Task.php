<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Notifications\Notifiable;
class Task extends Model
{
    use HasFactory;
   //Notifiable
    
    protected $fillable = [
        'title', 'description', 'programmer_id', 'tester_id', 'status', 'priority', 'scheduled_for_date', 'original_scheduled_date',
    ];

    // علاقة مع المستخدم كمبرمج
    public function programmer()
    {
        return $this->belongsTo(User::class, 'programmer_id');
    }

    // علاقة مع المستخدم كتيستر
    public function tester()
    {
        return $this->belongsTo(User::class, 'tester_id');
    }

    // علاقة مع سجل تغييرات المهام
    public function taskActivityLogs()
    {
        return $this->hasMany(TaskActivityLog::class, 'task_id');
    }
    public function teamLeader()
{
    return $this->belongsTo(User::class, 'team_leader_id');
}
}