<?php

namespace App\Http\Controllers;

use App\Models\LotteryGame;

class LotteryGameController extends Controller
{
    public function list()
    {
        $lotteries = LotteryGame::all();
        //добавить вывод всех ее матчей, отсортированных
        //по дате и времени начала
        //можно еще пагинацию добавить
        return response()->json(['message'=>'requested list', 'data'=>$lotteries]);
    }
}
