<?php

namespace App\Events;

use App\Http\Resources\Message\MessageResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendLikeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $message;
    private int $uid;

    /**
     * Create a new event instance.
     */
    public function __construct(string $message, int $uid)
    {
        $this->message = $message;
        $this->uid = $uid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('send-like-' . $this->uid),
        ];
    }
    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'send-like';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        $message = explode(' ', $this->message);
        $finalMessage = "Твой профиль лайкнул пользователь с именем: " . $message[count($message) - 1];
        return [
            'message' => $finalMessage
        ];
    }

}
