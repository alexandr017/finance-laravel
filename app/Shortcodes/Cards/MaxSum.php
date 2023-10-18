<?php
namespace App\Shortcodes\Cards;

use App\Shortcodes\BaseShortcode;

class MaxSum extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
    	if(isset($GLOBALS['max_sum'])){
        	return $GLOBALS['max_sum'];
	    } else {
	    	global $c;
	    	if(isset($c[0]->category_id)){

	    		switch ($c[0]->category_id) {
	    			case '1': $field = 'header_1'; break;
	    			case '2': $field = 'maintenance'; break;
	    			case '3': $field = 'sum_max'; break;
	    			case '4': $field = 'header_1'; break;
	    			case '5': $field = 'limit_max'; break;
	    			default: $field = ''; break;
	    		}
	    		if($field == '') return 0;

	    		$max_sum = 0;
	    		foreach ($c as $key => $value) {
	    			if($value->$field>$max_sum) $max_sum = $value->$field;
	    		}
	    		$GLOBALS['max_sum'] = number_format($max_sum, 0, '.', ' ');
	        	return number_format($max_sum, 0, '.', ' ');

	    	} else {
	    		$GLOBALS['max_sum'] = 0;
	    		return 0;
	    	}

	    }
    }

}