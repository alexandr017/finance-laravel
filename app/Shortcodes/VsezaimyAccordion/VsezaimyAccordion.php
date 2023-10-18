<?php
namespace App\Shortcodes\VsezaimyAccordion;

use App\Shortcodes\BaseShortcode;

class VsezaimyAccordion extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('vsezaimy_accordion',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='vsezaimy_accordion';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/vsezaimy_accordion/vsezaimy_accordion/$this->template.blade.php")) {
            return view("short_codes.vsezaimy_accordion.vsezaimy_accordion.$this->template",compact('content'));
        }

        return;
    }

}