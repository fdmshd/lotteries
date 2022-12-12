<?php

namespace App\Http\Controllers;

use App\Models\LotteryGame;

class LotteryGameController extends Controller
{
    public function list()
    {
        $lotteries = LotteryGame::all();
        foreach ($lotteries as $lottery) {
            $lottery->matches;
        }
        return response()->json(['message' => 'requested list', 'data' => $lotteries]);
    }
}
