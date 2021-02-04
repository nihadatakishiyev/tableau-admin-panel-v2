<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogoutSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        dd($event->user->id);
        $event->subject = 'logout';
        $event->description = "Logout Successful";

//        Session::flash('login-success', 'Hello ' . $event->user->name . ', welcome back!');
        activity($event->subject)
            ->by($event->user)
            ->log($event->description);
    }
}
