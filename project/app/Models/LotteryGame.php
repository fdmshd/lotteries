<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryGame extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'gamer_count',
        'reward_points',
    ];

    function matches()
    {
        return $this->hasMany(LotteryGameMatch::class, foreignKey: 'game_id')
            ->orderBy('start_date')
            ->orderBy('start_time');
    }
}
