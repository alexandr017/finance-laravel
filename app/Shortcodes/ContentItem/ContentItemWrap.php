<?php
namespace App\Shortcodes\ContentItem;

use App\Shortcodes\BaseShortcode;

class ContentItemWrap extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
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
        if (file_exists(resource_path() . "/views/short_codes/content_item/content_item_wrap/$this->template.blade.php")) {
            return view("short_codes.content_item.content_item_wrap.$this->template", compact('content'));
        }

        return;
    }
  
}