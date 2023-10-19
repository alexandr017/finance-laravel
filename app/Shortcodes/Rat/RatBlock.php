<?php
namespace App\Shortcodes\Rat;

use App\Shortcodes\BaseShortcode;

class RatBlock extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
	  	$rating = $shortcode->rating;
	  	$title = $shortcode->title;
	  	$img = $shortcode->img;
	  	//$img = 'https://finance.ru/' . $img; // !!!!!!!!!!!!!!!!!!!!!!!!!!

	    $rating = str_replace(',', '.', $rating);
    	$i_code = '';

    	switch ($rating) {
            case '1':
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break;
            case '1.5':
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break;
            case '2.0':
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break; 
            case '2.5':
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break; 
            case '3.0':
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break; 
            case '3.5':
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break; 
            case '4.0':
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
                break; 
            case '4.5':
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
                break;                                 
            case '5.0':
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                break;
            default:
                $i_code = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                break;
        }

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('rat',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='rat';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/rat/rat_block/$this->template.blade.php")) {
            return view("site.v3.shortcodes.rat.rat_block.$this->template",compact('img','title','i_code','content'));
        }

        return;
    }
  
}