<?php

namespace App\Http\Controllers;

use App\Models\LotteryGameMatchUser;
use Illuminate\Http\Request;

class LotteryGameMatchUserController extends Controller
{
    public function signUpForMatch(Request $request){
        $this->validate($request, [
            'match_id' =>'required|integer|numeric',
        ]);

        $matchUser = new LotteryGameMatchUser();
        $matchUser->user_id = $request->auth->id;
        $matchUser->lottery_game_match_id = $request->match_id;
        $matchUser->save();
        return response()->json(['message' => 'successfully signed up', 'data' => $matchUser], 201);
    }
}
