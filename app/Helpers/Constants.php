<?php

namespace App\Helpers;

/**
 * Class Constants
 * @package App\Utils
 */
class Constants
{
    const FCM_KEY = "key=AAAAkGaY0cY:APA91bFF0fvzzhkpo_jJw5i8mLtBdvUdICMoGGRUp4RIwYpKDcOIehJt7V4dVW9Ll8P58FCyynZ5376mljSD9fz5J2fYAb4hiNMav5VSmz9pNhwdt-RNmXi70MNn8pQOd6X7SOhEAHv";
    const APP_NAME = "STARTER";
    const IMAGE_FORMAT_PNG = "png";
    const SYSTEM = "System";
    const ACTIVE = true;
    const NON_ACTIVE = false;
    const ENCRYPT = 'encrypt';
    const DECRYPT = 'decrypt';
    const POST = 'POST';
    const GET = 'GET';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
    const ERROR = 'ERROR';
    const INFO = 'INFO';
    const WARNING = 'WARNING';
    const REQUEST = 'REQUEST';
    const RESPONSE = 'RESPONSE';
    const DATE_TIME_YYYY_MM_DD_HH_MM_SS = 'Y-m-d H:i:s';
    const DATE_YYYY_MM_DD = 'Y-m-d';
    const ATTENDANCE_DIR = 'attendance';
    const CLOCK_IN = 'IN';
    const CLOCK_OUT = 'OUT';

    //ERROR CODE
    const HTTP_CODE_200 = 200;
    const HTTP_CODE_404 = 404;
    const HTTP_CODE_500 = 500;
    const HTTP_CODE_409 = 409;
    const HTTP_CODE_401 = 401;
    const HTTP_CODE_403 = 403;
    const HTTP_CODE_422 = 422;
    const HTTP_CODE_406 = 406;

    const ERROR_CODE_9000 = 9000;
    const ERROR_CODE_9001 = 9001;
    const ERROR_CODE_9002 = 9002;
    const ERROR_CODE_9003 = 9003;
    const ERROR_CODE_9004 = 9004;
    const ERROR_CODE_9005 = 9005;
    const ERROR_CODE_9006 = 9006;
    const ERROR_CODE_9007 = 9007;
    const ERROR_CODE_9008 = 9008;
    const ERROR_CODE_9009 = 9009;


    //ERROR MESSAGE
    const HTTP_MESSAGE_200 = 'Success';
    const ERROR_MESSAGE_404 = 'Not Found';
    const ERROR_MESSAGE_401 = 'Unauthorized';
    const ERROR_MESSAGE_403 = 'Forbidden';
    const ERROR_MESSAGE_409 = 'Conflict';
    const ERROR_MESSAGE_422 = 'Unprocessable Entity';
    const ERROR_MESSAGE_406 = "You don't have authorization";
    const ERROR_MESSAGE_500 = 'Internal Server Error';
    const ERROR_MESSAGE_9000 = 'Error Business Exception';
    const ERROR_MESSAGE_9001 = 'Record Not Found';
    const ERROR_MESSAGE_9002 = 'Account Not Found';
    const ERROR_MESSAGE_9003 = 'Your account inactive';
    const ERROR_MESSAGE_9004 = "Invalid OTP code";
    const ERROR_MESSAGE_9005 = 'Error Http Request';
    const ERROR_MESSAGE_9006 = 'User already exists';
    const ERROR_MESSAGE_9007 = 'Please attend';
    const ERROR_MESSAGE_9008 = 'Invalid file format';
    const ERROR_MESSAGE_9009 = 'Record already exists';
}
