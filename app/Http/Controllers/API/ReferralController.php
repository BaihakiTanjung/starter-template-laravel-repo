<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Refferal;
use App\Http\Controllers\ApiController;
use App\Repositories\Referral\ReferralRepository;
use App\Repositories\User\UserRepository;

class ReferralController extends ApiController
{
    private $referalRepository;
    private $userRepository;

    public function __construct(ReferralRepository $referalRepository, UserRepository $userRepository)
    {
        $this->referalRepository = $referalRepository;
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {
        return $this->referalRepository->register($request, $this->userRepository);
    }

    public function verifyOtp(Request $request)
    {
        return $this->referalRepository->verifyOtp($request);
    }
}
