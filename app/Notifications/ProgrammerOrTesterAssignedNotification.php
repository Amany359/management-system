<?php

namespace App\Notifications;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProgrammerOrTesterAssignedNotification extends Notification
{
    use Queueable;
    protected Task $task;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task)
    {
       $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('تم تعيينك في مهمة جديدة')
            ->greeting('مرحبًا ' . $notifiable->name)
            ->line('لقد تم تعيينك في المهمة: ' . $this->task->title)
            ->line('الوصف: ' . $this->task->description)
            ->action('عرض المهمة', url('/tasks/' . $this->task->id))
            ->line('شكرًا لاستخدامك نظام إدارة المهام.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
           'task_id' => $this->task->id,
        ];
    }
}
