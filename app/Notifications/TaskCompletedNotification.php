<?php

namespace App\Notifications;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCompletedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
     protected Task $task;

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
            ->subject('✅ المهمة اكتملت')
            ->greeting('مرحبًا ' . $notifiable->name)
            ->line('تم اكتمال المهمة "' . $this->task->title . '" وتغيير حالتها إلى tested_done.')
            ->action('عرض المهمة', url('/tasks/' . $this->task->id))
            ->line('شكرًا لك على عملك!');
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
            'status' => 'tested_done',
        ];
    }
}
