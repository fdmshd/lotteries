<?php

namespace App\Events;

use App\Models\LotteryGameMatch;

class FinishMatchEvent
{

    public $match;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(LotteryGameMatch $match)
    {
        $this->match = $match;
    }

}
