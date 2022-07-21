<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    public function getUserById($id);
    public function getLastId();
    public function create($request);
}
