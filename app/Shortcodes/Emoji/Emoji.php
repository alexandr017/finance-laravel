<?php
namespace App\Shortcodes\Emoji;

use App\Shortcodes\BaseShortcode;

class Emoji extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if($shortcode->code != null){
            return '&#'.$shortcode->code;
        }
    }

}