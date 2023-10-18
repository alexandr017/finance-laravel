<?php
namespace App\Shortcodes\OfRat;

use App\Shortcodes\BaseShortcode;

class OfRatPlus extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('of_rat',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='of_rat';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/of_rat/of_rat_plus/$this->template.blade.php")) {
            return view("short_codes.of_rat.of_rat_plus.$this->template",compact('content'));
        }

        return;
    }

}