<?php
namespace App\Shortcodes\Cards;

use App\Shortcodes\BaseShortcode;

class MinMaintenance extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
    	if(isset($GLOBALS['min_maintenance'])){
        	return $GLOBALS['min_maintenance'];
	    } else {
	    	global $c;
	    	if(isset($c[0]->category_id)){

	    		switch ($c[0]->category_id) {
	    			case '2': $field = 'maintenance'; break;
	    			case '6': $field = 'maintenance'; break;
	    			default: $field = ''; break;
	    		}
	    		if($field == '') return 0;

	    		$min_maintenance = 10000;
	    		foreach ($c as $key => $value) {
	    			if(($value->$field<$min_maintenance) && ($value->$field!==null)) $min_maintenance = $value->$field;
	    		}
	    		$GLOBALS['min_maintenance'] = $min_maintenance;
	        	return $min_maintenance;

	    	} else {
	    		$GLOBALS['min_maintenance'] = 0;
	    		return 0;
	    	}

	    }
    }

}