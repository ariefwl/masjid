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

class SaldoAkhirKas implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $saldoAkhir;
    /**
     * Create a new event instance.
     */
    public function __construct(public string $saldoAkhir)
    {
        // $this->saldoAkhir = $saldoAkhir;
    }
    
    public function broadcastOn(): array
    {
        return [
            new Channel('channel-sakhir'),
        ];
    }
}
