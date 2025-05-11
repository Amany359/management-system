<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Task;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /*
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }



     // علاقة مع جدول المهام (Tasks) حيث المستخدم هو المبرمج
     public function tasksAsProgrammer()
     {
         return $this->hasMany(Task::class, 'programmer_id');
     }
 
     // علاقة مع جدول المهام (Tasks) حيث المستخدم هو التيستر
     public function tasksAsTester()
     {
         return $this->hasMany(Task::class, 'tester_id');
     }
 
     // علاقة مع سجل تغييرات المهام (TaskActivityLog) حيث المستخدم هو الذي قام بالتغيير
     public function taskActivityLogs()
     {
         return $this->hasMany(TaskActivityLog::class, 'changed_by');

     }
     public function tasksAsTeamLeader()
{
    return $this->hasMany(Task::class, 'team_leader_id');
}
 }

