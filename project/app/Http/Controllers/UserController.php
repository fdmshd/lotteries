<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        return response()->json(['message' => 'successfully registered', 'data' => $user], 201);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'string|required|max:64'
        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Wrong password'], 400);
        }

        //создать и вернуть токен

        return response()->json(['message' => 'successfully logged in', 'data' => $user], 200);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'string|max:64',
            'last_name' => 'string|max:64',
            'email' => 'email|unique:users',
        ]);

        $user = User::find($request->id);
        $user->first_name = $request->first_name ?? $user->first_name;
        $user->last_name = $request->last_name  ?? $user->last_name;
        $user->email = $request->email ?? $user->email;

        $user->save();

        return response()->json(['message' => 'successfully updated', 'data' => $user], 200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'successfully deleted', 'data' => $user], 204);
    }

    public function list()
    {
        $users = User::all();
        return response()->json($users);
    }
}
