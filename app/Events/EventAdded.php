<?php
// app/Events/EventAdded.php

namespace App\Events;

use Illuminate\Foundation\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Models\Event; // assuming you have an Event model

class EventAdded extends Event
{
    use SerializesModels;

    public $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }
}