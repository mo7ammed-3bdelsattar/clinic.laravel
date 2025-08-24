<?php

namespace App\Events;

use App\Models\User;
use App\Models\Message;
use App\Helpers\FileHelper;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public function __construct(public Message $message, public User $receiver , public User $sender)
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
        $minId = min($this->message->sender, $this->receiver->id);
        $maxId = max($this->message->sender, $this->receiver->id);
        return [new Channel('chat.' . $minId . '.' . $maxId)];
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'sender' => $this->message->sender,
            'sender_name' => $this->message->senderUser?->name,
            'receiver' => $this->message->receiver,
            'message' => $this->message->message,
            'image' => FileHelper::get_file_path($this->message->senderUser?->image?->path,'user'),
            'sent_at' => $this->message->created_at->toISOString(), // UTC format
        ];
    }
    public function broadcastAs(): string
    {
        return 'message.sent';
    }
}
