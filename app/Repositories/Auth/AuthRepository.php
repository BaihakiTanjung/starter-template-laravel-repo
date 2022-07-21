<?php

namespace App\Repositories\Auth;

use LaravelEasyRepository\Repository;

interface AuthRepository extends Repository
{
    public function login($request);
    public function register($request);
    public function profile();
    public function logout();
    public function sendOtp($request);
    public function verifyOtp($request);
    public function changePassword($request);

    // Forgot Password Flow
    public function forgotPassword($request);
    public function verifyForgotPassword($request);
    public function resetPassword($request);
    // End Forgot Password Flow
}
