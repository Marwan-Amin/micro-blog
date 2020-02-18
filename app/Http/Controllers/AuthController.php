<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Cache\RateLimiter;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use  ThrottlesLogins;

    protected $decayMinutes = 5 ;

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

    public function username(){
        return 'email';
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        
        $credentials= $request->only(['email','password']);
        $token = auth()->attempt($credentials);    

        

        //Login throttle 

        if ($this->hasTooManyLoginAttempts($request)){
            //Fire the lockout event.
            $this->fireLockoutEvent($request);
            return response()->json(['error' => 'You have been blocked for 30 minutes']);

    
            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        } else {
            if ($token) {
                return response()->json([
                    'message' => 'logged in',
                    'Token' => $token
                ]); 
            }
        }
    
        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        return response()->json([
            'error' => 'Invalid email or password',
            'Attempts left' =>  'you have Entered '.$this->limiter()->attempts($this->throttleKey($request)). ' of 5 Login attempts wrong'          
        ]);
    }

    public function follow($id)
    {
        $user = User::find($id);
        
        Follower::create([
            'user_id' => Auth::user()->id,
            'following_id' => $user->id
        ]);

    
        return response()->json([
                'message' => 'Successfully followed the user.',
            ]); 
    
    }

    public function unFollow($id)
    {
        $user = User::find($id);
        
        Follower::where([
            'user_id' => Auth::user()->id,
            'following_id' => $user->id
        ])->delete();

    
        return response()->json([
                'message' => ' unfollowed the user.',
            ]); 
    
    }

}
