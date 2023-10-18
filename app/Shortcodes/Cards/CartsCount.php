<?php
namespace App\Shortcodes\Cards;

use App\Shortcodes\BaseShortcode;

class CartsCount extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
    	global $c;

    	if($c != null) {
            return count($c);
        }

        return 0;
    }

}