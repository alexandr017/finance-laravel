<?php
namespace App\Shortcodes\Phone;

use App\Shortcodes\BaseShortcode;

class Phone extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

      	$number = $shortcode->number;

      	if($number == null)
      	    return '';
        if (! isset($this->template)) {
            return;
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/phone/phone/$this->template.blade.php")) {
            return view("site.v3.shortcodes.phone.phone.$this->template",compact('number','content'));
        }

        return;
    }

}