<?php

namespace App\Events;

use App\Helpers\NotificationHelper;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

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
    public function __construct(Model $model, string $title, string $message, string $icon = '')
    {
        $this->id = $model->id;
        $this->type = NotificationHelper::getType($model);
        $this->title = $title;
        $this->message = $message;
        $this->icon = $icon;
    }
}
