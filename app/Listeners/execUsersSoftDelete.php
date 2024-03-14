<?php

namespace App\Listeners;

use App\Events\UsersSoftDelete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class execUsersSoftDelete
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UsersSoftDelete $event): void
    {
        //
        $userId = $event->user->id;
        $event->user->posts()->where('user_id', $userId)->delete();
    }
}
