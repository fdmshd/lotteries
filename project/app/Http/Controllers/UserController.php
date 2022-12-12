<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "lotteries_api", // Issuer of the token
            'id' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60 * 60 // Expiration time
        ];

        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

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

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'Email does not exist.'], 400);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Wrong password'], 400);
        }

        return response()->json([
            'message' => 'successfully logged in',
            'data' => $user,
            'token' => $this->jwt($user)
        ], 200);
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
        foreach ($users as $user) {
            $user->matchesWon;
        }
        return response()->json(['message' => 'requested list', 'data' => $users], 200);
    }

    public function getByID($id)
    {
        $user = User::find($id);
        $user->matchesWon;
        return response()->json(['message' => 'requested user', 'data' => $user], 200);
    }
}
