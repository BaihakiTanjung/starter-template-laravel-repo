<?php

namespace App\Repositories\Referral;

use LaravelEasyRepository\Repository;

interface ReferralRepository extends Repository
{

    public function register($request, $userRepository);
    public function verifyOtp($request);
    public function list();
}
