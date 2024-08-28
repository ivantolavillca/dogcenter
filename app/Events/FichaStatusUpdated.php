<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FichaStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
   // public $nombre;
    public function __construct()
    {
        //$this->nombre = "hola como estas";
    }
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
       // return 'ficha-channel';
        return ['ficha-channel'];
    }
    public function broadcastAs()
    {
        //return new PrivateChannel('channel-name');
        return 'ficha-event';
    }
}
