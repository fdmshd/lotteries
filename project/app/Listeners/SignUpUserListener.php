<?php

namespace App\Listeners;

use App\Models\LotteryGameMatchUser;
use App\Models\LotteryGameMatch;
use App\Events\SignUpUserEvent;
use Exception;
use Illuminate\Support\Facades\Log;

class SignUpUserListener
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
     * @param  \App\Events\SignUpUserEvent  $event
     * @return void
     */
    public function handle(SignUpUserEvent $event)
    {  
        $checkUserMatch = LotteryGameMatchUser::where('user_id', $event->matchUser->user_id)
            ->where('lottery_game_match_id', $event->matchUser->lottery_game_match_id)
            ->first();
        if ($checkUserMatch) {
            throw new Exception('User alredy signed up to this match');
        }
        $match = $event->matchUser->match;
        //dd($match);
        $usersCount = $match->matchUsers->count();
        $limit = $match->game->gamer_count;
        if ($usersCount >= $limit) {
            throw new Exception("This match is already filled with users");
        }
        $event->matchUser->save();
    }
}
