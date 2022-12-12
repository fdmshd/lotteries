<?php

namespace App\Http\Controllers;

use App\Events\FinishMatchEvent;
use App\Models\LotteryGameMatch;
use Illuminate\Http\Request;
use Exception;

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
        $lotteryMatch = LotteryGameMatch::find($id);
        if (!$lotteryMatch) {
            return response()->json(['error' => 'Match does not exist.'], 400);
        }
        try {
            event(new FinishMatchEvent($lotteryMatch));
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
        return response()->json(['message' => 'successfully finished', 'data' => $lotteryMatch], 200);
    }

    public function getByLotteryID(Request $request)
    {
        $gameID = $request->query('lottery_game_id');
        $lotteryMatches = LotteryGameMatch::where('game_id', $gameID)->get();
        return response()->json(['message' => 'requested list', 'data' => $lotteryMatches], 200);
    }
}
