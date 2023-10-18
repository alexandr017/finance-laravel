<?php

namespace App\Models\GoogleCaptcha;
use App\Models\GoogleCaptcha\GoogleCaptcha;


class GoogleCaptcha{

	private static $SECRET_KEY = '6LdYqz0UAAAAABeYZCRt536o2AkYeCFFZBfwuGBW';

    public static function init($captcha){
        if(!$captcha){
          return false;
        }
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".self::$SECRET_KEY."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
        return $response['success'];  	
    }
}
