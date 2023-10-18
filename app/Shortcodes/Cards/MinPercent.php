<?php
namespace App\Shortcodes\Cards;

use App\Shortcodes\BaseShortcode;

class MinPercent extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
    	if(isset($GLOBALS['min_percent'])){
        	return $GLOBALS['min_percent'];
	    } else {
	    	global $c;
	    	if(isset($c[0]->category_id)){

	    		switch ($c[0]->category_id) {
	    			case '4': $field = 'header_3'; break;
	    			case '5': $field = 'percent_min'; break;
	    			default: $field = ''; break;
	    		}
	    		if($field == '') return 0;

	    		$min_percent = 100;
	    		foreach ($c as $key => $value) {
	    			if(($value->$field<$min_percent) && ($value->$field!=0) ) $min_percent = $value->$field;
	    		}
	    		$GLOBALS['min_percent'] = $min_percent;
	        	return $min_percent;

	    	} else {
	    		$GLOBALS['min_percent'] = 0;
	    		return 0;
	    	}

	    }
    }

}