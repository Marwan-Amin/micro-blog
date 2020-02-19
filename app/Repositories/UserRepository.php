<?php

namespace App\Repositories;

use App\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findByID($userId)
    {
        return User::where('id',$userId)->firstOrFail();
    }

    public function authUserID()
    {
        return Auth::user()->id;
    }
}