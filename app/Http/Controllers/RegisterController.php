<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register(Request $request) {
        // $userData = $request->except('password');
        // $userData = $request->only(['name', 'email', 'password']);
        // $password = $request->get('password');
        // $user = User::create($userData);
        // $authUser= $user->update(['password'=>bcrypt($password)]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)]);

        $addUserProfile = UserProfile::create([
            'nik'=>$request->nik,
            'name'=>$request->name_profile,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'user_id'=>$user->id,
            'zip_code'=>$request->zip_code]);

        return response()->json([
            'status'=>'Success',
            'message'=>'User success register please check your email',
            // 'expires_in' => auth()->factory()->getTTL() * 60,
            // 'user' => auth()->user()->load(['userProfile'])
            'user'=>[
                'email'=>$user->email,
                'name'=>$user->name,
            ]
        ], 201);

    }
}
