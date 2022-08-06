<?php

namespace App\Listeners;

use App\Events\Voted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateEnqueteAboutVote
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
     * @param  \App\Events\Voted  $event
     * @return void
     */
    public function handle(Voted $event)
    {

    }
}
