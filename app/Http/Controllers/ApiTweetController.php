<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweetRequest;
use App\Tweet;
use App\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTweetController extends Controller
{
    // public function __construct()
    // {
    //     dd('sasd');
    // }
    public function addTweet(StoreTweetRequest $request)
    {

        $tweet= $request->only(['tweet']);

        $tweet=new Tweet($tweet);
        $tweet->user_id = Auth::user()->id;
        $tweet->save();


        return response()->json([
            'message' =>'Tweet was added successfully',
            'tweet' => $tweet->tweet,
            'posted' => $tweet->updated_at->diffForHumans()
        ],201);
    }

    public function showAllFollowingsTweets(Request $request)
    {  
        $followings = Auth::user()->followings()->with('tweets')->paginate(1);
        return response()->json([$followings]);
    }


    public function destroy($id)
    {
        $tweet = Tweet::find($id);
        $tweet->delete();
        return response()->json([
            'message' => 'record deleted successfully'
        ]);
    }


}
