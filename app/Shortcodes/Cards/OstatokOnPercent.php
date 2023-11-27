<?php
namespace App\Shortcodes\Cards;

use App\Shortcodes\BaseShortcode;

class OstatokOnPercent extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false)
    {
        global $c;

    	if(isset($GLOBALS['ostatok_on_percent'])){
        	return $GLOBALS['ostatok_on_percent'];
	    } else {

	    	if(isset($c[0]->category_id)){

	    		switch ($c[0]->category_id) {
	    			case '6': $field = 'percent_on_balance'; break;
	    			default: $field = ''; break;
	    		}
	    		if($field == '') return 0;

	    		$ostatok_on_percent = 0;
	    		foreach ($c as $key => $value) {
	    			if($value->$field>$ostatok_on_percent ) $ostatok_on_percent = $value->$field;
	    		}
	    		$GLOBALS['ostatok_on_percent'] = $ostatok_on_percent;
	        	return $ostatok_on_percent;

	    	} else {
	    		$GLOBALS['ostatok_on_percent'] = 0;
	    		return 0;
	    	}

	    }
    }

}