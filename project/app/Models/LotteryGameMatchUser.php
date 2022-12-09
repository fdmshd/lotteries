<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotteryGameMatchUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'lottery_game_match_id'
    ];
}