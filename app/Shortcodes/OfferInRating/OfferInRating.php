<?php
namespace App\Shortcodes\OfferInRating;

use App\Shortcodes\BaseShortcode;

class OfferInRating extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
      	$place = $shortcode->place;
      	$img = trim($shortcode->img);
        $title = $shortcode->title;
        $link = $shortcode->link;
      	$text = $shortcode->text;

        $onclick = '';

        $class = '';

        if( $_SERVER['REQUEST_URI'] == '/reviews/best-ibank-ip.html') $class = 'clickrew';
        if( $_SERVER['REQUEST_URI'] == '/reviews/best-ibank-ooo.html') $class = 'clickrewooo';
        if( strstr($_SERVER['REQUEST_URI'],'ratings')) $class = 'offer-in-rating';

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('offer_in_rating',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='offer_in_rating';
        }
        if(!in_array('offer_in_rating',$GLOBALS['short_code_js'])){
            $GLOBALS['short_code_js'][]='offer_in_rating';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/offer_in_rating/$this->template.blade.php")) {
            return view("short_codes.offer_in_rating.$this->template",compact('place','img','title','text','content','onclick','class','link'));
        }

        return;
    }
  
}