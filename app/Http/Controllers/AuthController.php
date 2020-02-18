<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'image' => 'required',
            'date_of_birth' =>'required'
        ]);
        
        $data= $request->only(['name','email','password', 'image','date_of_birth']);

        $user=new User($data);
        $user->save();

        return response()->json([
            'message' =>'user registered successfully'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        

        $credentials= $request->only(['email','password']);
        $token = auth()->attempt($credentials);    

        if ($token) {
            return response()->json([
                'message' => 'logged in',
                'Token' => $token
            ], 401); 
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
