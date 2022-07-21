<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Otp;

/**
 * Class CommonUtil
 * @package App\Utils
 */
class CommonUtil
{

    const SECRET = 'iuijUiIzkenOESturU6B6uvyFuWuWlQYd9RA3SCFi2HTT4TCAOplVQxvFHfHkU8F';
    const KEY = 'Fno57wzUPEsJrPrzGQdyXmvoXJQSojzmjusdDziaGVk=';

    /**
     * @return string
     */
    public static function generateUUID(): string
    {
        return (string) Str::uuid();
    }

    /**
     * @param $code
     * @return string
     */
    public static function generateInvoiceNumber($code, $running_number): string
    {
        $year = DateTimeConverter::dateTimeFormatNow('Y');
        $month = DateTimeConverter::dateTimeFormatNow('m');
        return $code . $year . '/' . $month . '/' . $running_number;
    }

    /**
     * @return int
     */
    public static function randomNumber(): int
    {
        return mt_rand(100000, 999999);
    }

    /**
     * @param $phoneNumber
     * @return array|mixed|string|string[]
     */
    public static function phoneNumber($phoneNumber)
    {
        $phone = null;
        if ($phoneNumber !== null) {
            if ($phoneNumber[0] == '0') {
                $phone = substr_replace($phoneNumber, "62", "0", 1);
            } else if ($phoneNumber[0] == '+') {
                $phone = substr_replace($phoneNumber, "", "+", 1);
            } else {
                $phone = $phoneNumber;
            }
        }

        return $phone;
    }

    /**
     * @return string
     */
    public static function randomPassword(): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    /**
     * @param $value
     * @return string
     */
    public static function escape($value): string
    {
        $return = '';
        for ($i = 0; $i < strlen($value); ++$i) {
            $char = $value[$i];
            $ord = ord($char);
            if ($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126) {
                $return .= $char;
            } else {
                $return .= '\\x' . dechex($ord);
            }
        }
        return $return;
    }

    /**
     * @param $action
     * @param $string
     * @return false|string
     */
    public static function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        // hash
        $key = hash('sha256', self::KEY);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', self::SECRET), 0, 16);
        if ($action == Constants::ENCRYPT) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == Constants::DECRYPT) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    /**
     * @return string
     */
    public static function strGenerate($number = 6)
    {
        return Str::random($number);
    }

    /**
     * @return int
     */
    public static function intGenerate()
    {
        return mt_rand(100000, 999999);
    }



    public static function sendSms($noTelp, $textSms = "default", $desc = "Agreesip")
    {
        // Send sms gateway
        $curltoken = curl_init();
        $data = array('Username' => env('GM_USER', ''), 'password' => env('GM_PASS', ''));
        curl_setopt($curltoken, CURLOPT_URL, 'https://smsgw.sitama.co.id/api/oauth/token');
        curl_setopt($curltoken, CURLOPT_POST, 1);
        curl_setopt($curltoken, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curltoken, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curltoken, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curltoken);
        curl_close($curltoken);

        $tokenbearer = json_decode($result, true)['access_token'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://smsgw.sitama.co.id/api/SMS/smssitama',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                          "notelp": "' . $noTelp . '",
                                          "textsms": "' . $textSms . '",
                                          "desc": "' . $desc . '"
                                      }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $tokenbearer,
                'Content-Type: text/plain'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function generateOtp($indentifier, $length = 6, $minutes = 5)
    {
        $otp = new Otp;

        return $otp->generate($indentifier, $length, $minutes);
    }

    public static function verifyOtp($indentifier, $code_otp)
    {
        $otp = new Otp;

        return $otp->validate($indentifier, $code_otp);
    }
}
