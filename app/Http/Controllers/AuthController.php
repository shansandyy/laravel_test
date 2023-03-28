<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;

class AuthController extends Controller
{
    public function signUp(CreateUser $request)
    {
        $data = $request->validated();
        $user = new User(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]
        );
        $user->save();

        return response('success', 201);
    }
}
