<?php
namespace App\Shortcodes\Summary;


use App\Shortcodes\BaseShortcode;

class Summary extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('summary',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='summary';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/summary/$this->template.blade.php")) {
            return view("site.v3.shortcodes.summary.$this->template",compact('content'));
        }

        return;
    }

}