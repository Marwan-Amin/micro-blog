<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface TweetRepositoryInterface
{
    public function delete(int $id);

    public function create(Request $request);
    
    public function MessageFromCreate(Request $request);

    public function MessageFromDelete();

    public function showUserTweets();

    public function followingsTweet();

}
