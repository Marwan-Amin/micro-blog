<?php

namespace App\Repositories;

use App\Http\Requests\StoreTweetRequest;
use App\Tweet;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\TweetRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetRepository implements TweetRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(StoreTweetRequest $request)
    {
        Tweet::create([
            'tweet' => $request->tweet,
            'user_id' => Auth::user()->id
        ]);
    }

    public function showUserTweets()
    {
        $tweets = Tweet::where('user_id',Auth::user()->id)->get();
        
        return $tweets;
    }

    public function delete(int $id)
    {
        Tweet::find($id)->delete();
    }

    public function followingsTweet()
    {
        $followings = Auth::user()->followings()->with('tweets')->paginate(2);
        return $followings;
    }

    public function MessageFromCreate($request)
    {
        $getTweet = Tweet::where('tweet',$request->tweet)->first();
        return [
            'message' =>'Tweet added successfully',
            'tweet' => $request->tweet,
            'posted' => $getTweet->updated_at->diffForHumans(),
        ];
    }

    public function MessageFromDelete()
    {
        return [
            'message' =>'Tweet deleted successfully'
        ];
    }
}
