<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function findByID($id);

    public function authUserID();
}
