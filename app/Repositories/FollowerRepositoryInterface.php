<?php

namespace App\Repositories;

interface FollowerRepositoryInterface
{
    public function follow(array $data);

    public function unfollow(array $data);
}
