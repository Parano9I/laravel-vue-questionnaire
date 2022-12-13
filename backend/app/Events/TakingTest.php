<?php

namespace App\Events;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TakingTest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public Questionnaire $questionnaire;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Questionnaire $questionnaire)
    {
        $this->user = $user;
        $this->questionnaire = $questionnaire;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
