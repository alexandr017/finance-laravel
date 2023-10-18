<?php
namespace App\Shortcodes\MonthYear;

use App\Shortcodes\BaseShortcode;

class Year extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        //ddd(date('Y'));
        return 2021;
        return date('Y');
    }

}