<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function user(){
        return Auth::user();;
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))){
            return response([
                "message" => "Invalid credential"
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60*24);
        return response([
            "message" => "Succes",
        ])->withCookie($cookie);
    }

    public function register(Request $request){
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    public function logout(){
        $cookie = Cookie::forget('jwt');

        return response([
            "message" => "Succes"
        ])->withCookie($cookie);
    }
}