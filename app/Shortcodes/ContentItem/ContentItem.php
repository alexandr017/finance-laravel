<?php
namespace App\Shortcodes\ContentItem;

use App\Shortcodes\BaseShortcode;

class ContentItem extends BaseShortcode{

  	public function register($shortcode, $content, $compiler, $name, $viewData=false){
  		//dd($shortcode);
	  	$link = $shortcode->link;
	  	$img = trim($shortcode->img);
	  	$link_title = $shortcode->link_title;
        $alt = str_replace('"',"'",$content);
        $alt = str_replace('&laquo;',"'",$alt);
        if (! isset($this->template)) {
            return;
        }

        // на амп и турбо решили выпилить этот шорткод
        if ($this->template == 'amp' || $this->template == 'turbo') {
            return '';
        }


        if(!in_array('content_item',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='content_item';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/content_item/content_item/$this->template.blade.php")) {
            return view("short_codes.content_item.content_item.$this->template", compact('link','img','alt','link_title','content'));
        }

        return;

    }
  
}