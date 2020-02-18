<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Repositories\FollowerRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function __construct(User $user, Follower $follower)
    {
        $this->user = new UserRepository($user);
        $this->follower = new FollowerRepository($follower);

    }  

    public function follow(int $id)
    {
        $this->follower->follow(
            ['user_id' => $this->user->authUserID(), 
            'following_id' => $this->user->findByID($id)->id
        ]);
    
        return response()->json([
            'message'=> 'you have followed ' . $this->user->findByID($id)->name
        ]);
    }

    public function unfollow(int $id)
    {
        $this->follower->unfollow(
            ['user_id' => $this->user->authUserID(), 
            'following_id' => $this->user->findByID($id)->id
        ]);

        return response()->json([
            'message'=> 'you have unfollowed '. $this->user->findByID($id)->name
        ]);
    }
}
