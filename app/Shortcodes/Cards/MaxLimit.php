<?php
namespace App\Shortcodes\Cards;

use App\Shortcodes\BaseShortcode;

class MaxLimit extends BaseShortcode{
    public function register($shortcode, $content, $compiler, $name, $viewData=false){
		if(isset($GLOBALS['max_limit'])){
        	return $GLOBALS['max_limit'];
	    } else {
	    	global $c;
	    	if(isset($c[0]->category_id)){

	    		switch ($c[0]->category_id) {
	    			case '5': $field = 'limit_max'; break;
	    			default: $field = ''; break;
	    		}
	    		if($field == '') return 0;

	    		$max_sum = 0;
	    		foreach ($c as $key => $value) {
	    			if($value->$field>$max_sum) $max_sum = $value->$field;
	    		}
	    		$GLOBALS['max_limit'] = number_format($max_sum, 0, '.', ' ');
	        	return number_format($max_sum, 0, '.', ' ');

	    	} else {
	    		$GLOBALS['max_limit'] = 0;
	    		return 0;
	    	}

	    }
    }

}