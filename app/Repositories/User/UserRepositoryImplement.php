<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserById($id)
    {
        return $this->model->findOrFail($id)->first();
    }

    public function getLastId()
    {
        return $this->model->orderBy('id', 'desc')->first()->id;
    }

    public function create($request)
    {
        return $this->model->create($request);
    }
}
