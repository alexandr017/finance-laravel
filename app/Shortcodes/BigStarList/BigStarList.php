<?php
namespace App\Shortcodes\BigStarList;

use App\Shortcodes\BaseShortcode;

class BigStarList extends BaseShortcode {

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('big_star_list',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='big_star_list';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/big_star_list/$this->template.blade.php")) {
            return view("short_codes.big_star_list.$this->template", compact('content'));
        }

        return;
    }

}