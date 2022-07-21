<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class Base64Converter
 * @package App\Utils
 */
class Base64Converter
{

    /**
     * @param $data
     * @return string
     */
    public static function base64url_encode($data)
    {
        return base64_encode($data);
    }

    /**
     * @param $data
     * @return false|string
     */
    public static function base64url_decode($data)
    {
        return base64_decode($data);
    }

    /**
     * @param File $file
     * @return string
     */
    public static function imageConvertToBase(File $file): string
    {
        return base64_encode(file_get_contents($file));
    }


    /**
     * @param $base64_str
     * @return string
     */
    public static function base64ToImage($dir, $base64_str)
    {
        try {
            $base64 = preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $base64_str) ? explode(',', $base64_str) : $base64_str;
            $file = preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $base64_str) ? base64_decode($base64[1]) : base64_decode($base64);
            $safeName = CommonUtil::generateUUID() . '.' . Constants::IMAGE_FORMAT_PNG;
            $resized_image = Image::make($file)->resize(500, 500)->stream('png', 100);
            $path = "pms/$dir/" . basename($safeName);
            Storage::disk('sftp')->put("/pms/$dir/" . basename($safeName), $resized_image);
            return env('CDN_IMG_URL', "https://homestead.com") . '/storage/' . $path;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @param $dir
     * @param $base64
     * @return mixed|string
     */
    public static function isBase64($dir, $base64)
    {
        return preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $base64) ? self::base64ToImage($dir, $base64) : $base64;
    }
}
