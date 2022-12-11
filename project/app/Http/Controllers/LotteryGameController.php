<?php

namespace App\Http\Controllers;

use App\Models\LotteryGame;

class LotteryGameController extends Controller
{
    public function list()
    {
        $lotteries = LotteryGame::all();
        //можно пагинацию добавить
        return response()->json(['message'=>'requested list', 'data'=>$lotteries]);
    }
}
