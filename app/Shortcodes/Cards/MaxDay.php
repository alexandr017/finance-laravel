<?php
namespace App\Shortcodes\Cards;

use App\Shortcodes\BaseShortcode;

class MaxDay extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
    	if(isset($GLOBALS['max_day'])){
        	return $GLOBALS['max_day'];
	    } else {
	    	global $c;
	    	if(isset($c[0]->category_id)){

	    		switch ($c[0]->category_id) {
	    			case '1': $field = 'header_2'; break;
	    			case '3': $field = 'term_max'; break;
	    			default: $field = ''; break;
	    		}
	    		if($field == '') return 0;

	    		$max_sum = 0;
	    		foreach ($c as $key => $value) {
	    			if($value->$field>$max_sum) $max_sum = $value->$field;
	    		}
	    		$GLOBALS['max_day'] = $max_sum;
	        	return $max_sum;

	    	} else {
	    		$GLOBALS['max_day'] = 0;
	    		return 0;
	    	}

	    }
    }

}