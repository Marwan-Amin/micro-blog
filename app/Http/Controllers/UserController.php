<?php

namespace App\Http\Controllers;

use App\User;
use App\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('Users.index',[
            'users' => User::all() 
        ]);
    }

    public function followUser(int $id)
    {
    $user = User::find($id);
    Follower::create([
        'user_id' => Auth::user()->id,
        'following_id' => $user->id
    ]);

    return redirect()->back()->with('success', 'Successfully followed the user.');
    }

    public function unFollowUser(int $id)
    {
    $user = User::find($id);
    // dd($user->id);

    Follower::where([
        'user_id' => Auth::user()->id,
        'following_id' => $user->id
    ])->delete();

    return redirect()->back()->with('success', 'Successfully unfollowed the user.');
    }
}
