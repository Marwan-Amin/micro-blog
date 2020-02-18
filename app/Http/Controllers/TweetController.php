<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function index()
    {        
        return view('Tweets.index',[
            'tweets' => Tweet::all()->where('user_id',Auth::user()->id)
        ]);
    }

    public function create()
    {
        return view('Tweets.create');
    }

    public function store(Request $request)
    {
        Tweet::create([
            'tweet' => $request->tweet,
            'user_id' =>Auth::user()->id
        ]);
        return redirect()->route('tweets.index');
    }

    public function destroy($id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->delete();

        return redirect()->route('tweets.index');
    }
}
