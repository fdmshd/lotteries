<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'string|required|max:64',
            'last_name' => 'string|required|max:64',
            'email' => 'required|email|unique:users',
            'password' => 'string|required|max:64'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message'=>'successfully registered', 'data'=>$user],201);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'string|required|max:64'
        ]);
        
        $user = User::where('email',$request->email)->firstOrFail();
        if (!Hash::check($request->password,$user->password)){
            return response()->json(['error'=>'Wrong password'],400);
        }
        return response()->json(['message'=>'successfully logged in', 'data'=>$user],200);
    }

    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }
}
