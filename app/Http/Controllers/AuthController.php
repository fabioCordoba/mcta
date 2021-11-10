<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ])->validate();

        $user  = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        $user->assignRole('USER');

        $token = $user->createToken('mcta_v1')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function login(Request $request)
    {
        $fields = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ])->validate();

        $user  = User::where('email',$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'noti' => 'Bad Creds'
            ], 401);
        }

        $token = $user->createToken('mcta_v1')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'noti' => 'Logged out'
        ];
    }
}
