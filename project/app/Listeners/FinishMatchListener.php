<?php

namespace App\Listeners;

use App\Models\LotteryGameMatch;
use App\Events\FinishMatchEvent;
use Exception;
use Illuminate\Support\Facades\Log;

class FinishMatchListener
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
     * @param  \App\Events\FinishMatchEvent  $event
     * @return void
     */
    public function handle(FinishMatchEvent $event)
    {  
        $match = $event->match;
        $matchUsers = $match->matchUsers;
        $winner = $matchUsers->random()->user;
        $winner->points+=$event->match->game->reward_points;
        $winner->save();

        $event->match->winner_id = $winner->id;
        $event->match->is_finished = true;
        $event->match->save();
    }
}
