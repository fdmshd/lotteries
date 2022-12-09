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

    public function winner(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->hasManyThrough(User::class,LotteryGameMatchUser::class);
    }
}