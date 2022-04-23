<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->validated())) {
            return response()->json([
                'status'=>'Error',
                'message'=>'Data not found'
            ], 400);
        }

        return $this->createNewToken($token);

    }

    protected function createNewToken($token)
    {
        return response()->json([
            'message'=>'Login success',
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    // public function refresh()
    // {
    //     return $this->createNewToken(auth()->refresh());
    // }

}
