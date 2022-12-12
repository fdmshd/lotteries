<?php

namespace App\Http\Controllers;

use App\Events\SignUpUserEvent;
use App\Models\LotteryGameMatchUser;
use Illuminate\Http\Request;
use Exception;

class LotteryGameMatchUserController extends Controller
{
    public function signUpForMatch(Request $request)
    {
        $this->validate($request, [
            'match_id' => 'required|integer|numeric',
        ]);

        $matchUser = new LotteryGameMatchUser();
        $matchUser->user_id = $request->auth->id;
        $matchUser->lottery_game_match_id = $request->match_id;
        try {
            event(new SignUpUserEvent($matchUser));
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
        return response()->json(['message' => 'successfully signed up', 'data' => $matchUser], 201);
    }
}
