<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LotteryGame;

const GAME_COUNT = 5;

class LotteryGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LotteryGame::factory()->count(GAME_COUNT)->create();
    }
}
