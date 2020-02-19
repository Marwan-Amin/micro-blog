<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweetRequest;
use App\Repositories\TweetRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Tweet;
use App\User;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function __construct(User $user, Tweet $tweet)
    {
        $this->user = new UserRepository($user);
        $this->tweet = new TweetRepository($tweet);
    }

    public function userTweets()
    {
        return response()->json($this->tweet->showUserTweets());
    }

    public function store(StoreTweetRequest $request)
    {
        $this->tweet->create($request);

        return response()->json($this->tweet->MessageFromCreate($request));
    }

    public function index()
    {  
        return response()->json([$this->tweet->followingsTweet()]);
    }

    public function destroy($id)
    {
        $this->tweet->delete($id);
        return response()->json($this->tweet->MessageFromDelete());
    }
}
