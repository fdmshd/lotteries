<?php

namespace App\Http\Controllers;

use App\Models\LotteryGameMatch;
use Illuminate\Http\Request;

class LotteryGameMatchController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'game_id' => 'required|integer|numeric',
            'start_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i'
        ]);

        $lotteryMatch = new LotteryGameMatch();
        $lotteryMatch->game_id = $request->game_id;
        $lotteryMatch->start_date = $request->start_date;
        $lotteryMatch->start_time = $request->start_time;
        $lotteryMatch->save();
        return response()->json(['message' => 'successfully created', 'data' => $lotteryMatch], 201);
    }

    public function finish($id)
    {
        $lotteryMatch = LotteryGameMatch::find($id); //Сделать обработку если не найдено
        $lotteryMatch->is_finished = true;
        return response()->json(['message' => 'successfully finished', 'data' => $lotteryMatch], 200);
    }

    public function getByLotteryID(Request $request)
    {
        $gameID = $request->query('lottery_game_id');
        $lotteryMatches = LotteryGameMatch::where('game_id', $gameID)->get(); //Сделать обработку если не найдено
        return response()->json(['message' => 'requested list', 'data' => $lotteryMatches], 200);
    }
}
