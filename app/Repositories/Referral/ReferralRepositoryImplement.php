<?php

namespace App\Repositories\Referral;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Referral;
use App\Traits\BaseResponse;
use Validator;
use Hash;
use App\Helpers\Constants;
use App\Helpers\CommonUtil;
use App\Traits\BusinessException;
use Otp;
use App\Jobs\JobOtp;
use App\Jobs\JobSmsOtp;

class ReferralRepositoryImplement extends Eloquent implements ReferralRepository
{

    use BaseResponse;

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Referral $model)
    {
        $this->model = $model;
    }


    public function register($request, $userRepository)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'no_hp' => 'required'
        ]);

        if ($validator->fails()) {
            throw new BusinessException(400, $validator->errors()->first(), Constants::HTTP_CODE_400);
        }

        $getLastId =  $userRepository->getLastId();

        $user = $userRepository->create([
            'referral_code' => CommonUtil::strGenerate(5) . $getLastId,
            'name' => $request['name'],
            'email' => 'default' . $getLastId . '@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'member'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $otp_token = CommonUtil::generateOtp($request->no_hp, 6, 5);

        // Send Sms
        try {
            $textSms = "Hi $request->name, kode OTP Agreesip anda adalah $otp_token->token";
            dispatch(new JobSmsOtp($request->no_hp, $textSms));
        } catch (\Throwable $th) {
            throw $th;
        }
        // End Sms

        return self::buildResponse(
            Constants::HTTP_CODE_200,
            Constants::HTTP_MESSAGE_200,
            (['access_token' => $token, 'user' => $user]),
            CommonUtil::generateUUID()
        );
    }

    public function verifyOtp($request)
    {


        $validator = Validator::make($request->all(), [
            'indentifier' => 'required',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            throw new BusinessException(400, $validator->errors()->first(), Constants::HTTP_CODE_400);
        }

        $validate_token = CommonUtil::verifyOtp($request->indentifier, $request->otp);

        if (!$validate_token->status) {
            throw new BusinessException(422, $validate_token->message, Constants::HTTP_CODE_422);
        }

        return self::statusResponse(
            Constants::HTTP_CODE_200,
            Constants::HTTP_MESSAGE_200,
            $validate_token->message,
            CommonUtil::generateUUID()
        );
    }

    public function list()
    {
        return $this->model->with(['sending_user', 'new_user'])->get();
    }
}
