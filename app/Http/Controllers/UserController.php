<?php

namespace App\Http\Controllers;

use App\User;
use App\Follower;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = new UserRepository($user);
    }
}
