<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\NotificationHelper;
use phpDocumentor\Reflection\Types\String_;

class SendNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $type;
    public $title;
    public $message;
    public $icon;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $model, String $title, String $message, String $icon  = '')
    {
        $this->id = $model->id;
        $this->type = NotificationHelper::getType($model);
        $this->title = $title;
        $this->message = $message;
        $this->icon = $icon;
    }
}
