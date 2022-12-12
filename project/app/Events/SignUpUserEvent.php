<?php

namespace App\Events;

use App\Models\LotteryGameMatchUser;
use Illuminate\Support\Facades\Log;

class SignUpUserEvent
{

    public $matchUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(LotteryGameMatchUser $matchUser)
    {
        Log::debug("enter event");
        $this->matchUser = $matchUser;
    }

}
