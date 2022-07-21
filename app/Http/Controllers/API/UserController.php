<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;

class UserController extends ApiController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findUserId($id)
    {
        $result = $this->userRepository->getUserById($id);

        return $this->successResponse($result);
    }
}
