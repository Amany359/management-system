<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;
class TaskStatusChanged
{


      use Dispatchable, SerializesModels;

    public $task;
    public $oldStatus;
    public $newStatus;
    public $changedBy;
    public $note;

    /**
     * Create a new event instance.
     *
     * @param  Task  $task
     * @param  string  $oldStatus
     * @param  string  $newStatus
     * @param  int  $changedBy
     * @param  string|null  $note
     * @return void
     */
    use Dispatchable, InteractsWithSockets, SerializesModels;
 
    /**
     * Create a new event instance.
     */
    public function __construct(Task $task, $oldStatus, $newStatus, $changedBy, $note = null)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
