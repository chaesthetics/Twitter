<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SigninRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Resources\Auth\AuthResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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
            if(Auth::attempt($credentials)) {

                $user = User::where('email', $request->email)->first();
                $token = $user->createToken('myToken')->plainTextToken;

                return AuthResource::make([
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'firstname' => $user->firstname,
                        'lastname' => $user->lastname,
                        'email' => $user->email,
                        'bio' => $user->bio,
                        'avatar' => $user->avatar,
                        'cover' => $user->cover,
                    ]
                ]);
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
