<?php

namespace App\Repositories;

use App\Http\Requests\StoreTweetRequest;
use Illuminate\Http\Request;

interface TweetRepositoryInterface
{
    public function delete(int $id);

    public function create(StoreTweetRequest $request);
    
    public function MessageFromCreate(Request $request);

    public function MessageFromDelete();

    public function showUserTweets();

    public function followingsTweet();

}
