<?php
namespace App\Shortcodes\Phone;

use App\Shortcodes\BaseShortcode;

class PhoneWithImg extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

        $number = $shortcode->number;
        $img = $shortcode->img;

        if($number == null || $img == null)
            return '';

        if (! isset($this->template)) {
            return '';
        }

        // для АПМ не надо
        if ($this->template == 'amp') {
            return '';
        }



        if(!in_array('phone',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='phone';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/phone/phone_with_img/$this->template.blade.php")) {
            return view("short_codes.phone.phone_with_img.$this->template",compact('number','img', 'content'));
        }

        return;
    }

}