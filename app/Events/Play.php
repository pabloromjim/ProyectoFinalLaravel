<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Play implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $gameId;
    public $type;
    public $location;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($gameId, $type, $location, $userId)
    {
        $this->gameId = $gameId;
        $this->type = $type;
        $this->location = $location;
        $this->userId = $userId;
    }

    /**
     * Coge los canales donde se envian los eventos.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        //Usa un canal unico para cada jugador en cada partida
        return new Channel('game-channel-' . $this->gameId . '-' . $this->userId);
    }
}
