<?php

namespace App\Repositories;

use App\Follower;
use App\Repositories\FollowerRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FollowerRepository implements FollowerRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function follow(array $data)
    {
        Follower::create($data);
        
    }

    public function unfollow(array $data)
    {
        Follower::where($data)->delete();
    }

}
