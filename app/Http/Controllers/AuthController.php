<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(CreateUser $request)
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

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($data)) {
            return response('授權失敗', 401);
        };

        $user = $request->user();
        $tokenRes = $user->createToken('token');
        $tokenRes->token->save();
        // dd(['token'=>$tokenRes->accessToken]);
        return response()->json(['token' => $tokenRes->accessToken]);
    }

    public function user(Request $request)
    {
        return response($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(['message' => '登出成功']);
    }
}
