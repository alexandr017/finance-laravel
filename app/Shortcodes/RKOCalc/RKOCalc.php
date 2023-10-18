<?php
namespace App\Shortcodes\RKOCalc;

use App\Shortcodes\BaseShortcode;

class RKOCalc extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('rko_calc_ooo_and_ip',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='rko_calc_ooo_and_ip';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/rko_calc_ooo_and_ip/$this->template.blade.php")) {
            return view("short_codes.rko_calc_ooo_and_ip.$this->template");
        }

        return;
    }

}