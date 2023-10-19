<?php
namespace App\Shortcodes\Alert;

use App\Shortcodes\BaseShortcode;

class AlertSuccess extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('alert',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='alert';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/alert/success/$this->template.blade.php")) {
            return view("site.v3.shortcodes.alert.success.$this->template", compact('content'));
        }

        return;
    }

}