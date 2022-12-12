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
        'is_finished'
    ];

    public function game()
    {
        return $this->belongsTo(LotteryGame::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class);
    }

    public function matchUsers()
    {
        return $this->hasMany(LotteryGameMatchUser::class, 'lottery_game_match_id');
    }
}
