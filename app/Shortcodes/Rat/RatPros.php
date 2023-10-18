<?php
namespace App\Shortcodes\Rat;

use App\Shortcodes\BaseShortcode;

class RatPros extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
	  	$title = $shortcode->title;
  	    $arr = array('title'=>$title,'content'=>$content);
    	$GLOBALS['pros'][] = $arr;
    	return '';
    }
  
}