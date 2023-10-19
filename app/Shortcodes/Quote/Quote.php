<?php
namespace App\Shortcodes\Quote;

use App\Shortcodes\BaseShortcode;

class Quote extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('quote',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='quote';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/promo/$this->template.blade.php")) {
            return view("site.v3.shortcodes.quote.$this->template",compact('content'));
        }

        return;
    }

}