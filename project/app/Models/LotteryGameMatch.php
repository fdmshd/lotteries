<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotteryGameMatch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'game_id',
        'start_date',
        'start_time',
        'winner_id',
    ];
}