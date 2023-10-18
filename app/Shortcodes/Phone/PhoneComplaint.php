<?php
namespace App\Shortcodes\Phone;

use App\Shortcodes\BaseShortcode;

class PhoneComplaint extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

        if(!in_array('phone_complaint',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='phone_complaint';
        }

        if(!in_array('phone_complaint',$GLOBALS['short_code_js'])){
            $GLOBALS['short_code_js'][]='phone_complaint';
        }

        if (file_exists(resource_path() . "/views/short_codes/phone/phone_complaint/$this->template.blade.php")) {
            return view("short_codes.phone.phone_complaint.$this->template");
        }

        return null;
    }

}