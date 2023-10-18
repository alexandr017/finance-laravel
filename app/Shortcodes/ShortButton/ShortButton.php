<?php
namespace App\Shortcodes\ShortButton;

use App\Shortcodes\BaseShortcode;

class ShortButton extends BaseShortcode{

  	public function register($shortcode, $content, $compiler, $name, $viewData=false){
	  	$link = $shortcode->link;
	  	$inline = $shortcode->inline;

	    $onclick = '';

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('short_button',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='short_button';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/short_button/$this->template.blade.php")) {
            return view("short_codes.short_button.$this->template",compact('onclick','link'));
        }

        return;
	}
}
