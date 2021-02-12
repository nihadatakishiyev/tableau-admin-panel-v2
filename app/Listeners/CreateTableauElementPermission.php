<?php

namespace App\Listeners;

use App\Events\TableauElementAdded;
use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;

class CreateTableauElementPermission
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
     * @param Dispatcher $events
     * @return void
     */
    public function handle(Dispatcher $events)
    {
        $events->listen(Project::created(), );
    }
}
