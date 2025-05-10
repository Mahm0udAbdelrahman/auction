<?php

namespace App\Events;

use App\Models\CommitAuction;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;


class AuctionEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $commit;


    public function __construct(CommitAuction $commit)
    {
        $this->commit = $commit;
    }

    public function broadcastOn()
    {
        return new Channel('mazad');
    }
    
    //  public function broadcastOn()
    // {
    //     // return new PrivateChannel('mazad' . $this->commit->auction_id);
    //     return new PrivateChannel('mazad.' . $this->commit->auction_id);

    // }


    public function broadcastAs()
    {
        return 'auction';
    }
    
    public function broadcastWith()
    {
        return [
            'id' => $this->commit->id,
            'user_id' => $this->commit->user->id,
            'user_name' => $this->commit->user->name,
            'user_service' => $this->commit->user->service,
            'user_image' => $this->commit->user->image,
            'car_name' => $this->commit->auction->car->name,
            'price' => $this->commit->price,
            'commit' => $this->commit->commit ?? null,
            'created_at' => $this->commit->created_at,
        ];
    }


}
