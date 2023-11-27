<?php
namespace App\Shortcodes\Cards;

use App\Shortcodes\BaseShortcode;

class MaxMaintenance extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false)
    {
        global $c;

    	if(isset($GLOBALS['max_maintenance'])){
        	return $GLOBALS['max_maintenance'];
	    } else {

	    	if(isset($c[0]->category_id)){

	    		switch ($c[0]->category_id) {
	    			case '2': $field = 'maintenance'; break;
	    			default: $field = ''; break;
	    		}
	    		if($field == '') return 0;

	    		$max_maintenance = 0;
	    		foreach ($c as $key => $value) {
	    			if($value->$field>$max_maintenance) $max_maintenance = $value->$field;
	    		}
	    		$GLOBALS['max_maintenance'] = $max_maintenance;
	        	return $max_maintenance;

	    	} else {
	    		$GLOBALS['max_maintenance'] = 0;
	    		return 0;
	    	}

	    }
    }

}