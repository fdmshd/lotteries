<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{

    /**
     *
     * @return Response
     */
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }
}
