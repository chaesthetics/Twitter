<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\SigninRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signup(SignupRequest $request)
    {
        try{
            $user = new User;

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;

            $passwordHash = Hash::make($request->password);
            $user->password = $passwordHash;

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function login(SigninRequest $request)
    {
        try{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Logged in successfully',
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid login credentials',
                ], 404);
            }
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }  
    }
}
