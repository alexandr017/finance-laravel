<?php
namespace App\Shortcodes\YaRTB;

use App\Shortcodes\BaseShortcode;

class YaRTB extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        return '';

        if (! isset($this->template)) {
            return;
        }

        // на амп и турбо решили выпилить этот шорткод
        if ($this->template == 'turbo') {
            return '<figure data-turbo-ad-id="footer_ad_place"></figure>';
        }

      	$height = $shortcode->height;
      	$width = $shortcode->width;
	    $height .= 'px';
    	if(!strstr($width,'%')) $width .= 'px';

    	$randID = rand(1,100000);

    	return '';


	}


	// [ya_RTB] -  100%x120
	// [ya_RTB height="180"] 
	// [ya_RTB height="180" width="500"]
	// [ya_RTB width="500"]
  
}