<?php
namespace App\Shortcodes\Promo;

use App\Shortcodes\BaseShortcode;

class Promo extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
      	$img = $shortcode->img;
        $link = $shortcode->link;
        $code = $shortcode->code;

        if (! isset($this->template)) {
            return;
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/promo/$this->template.blade.php")) {
            return view("site.v3.shortcodes.promo.$this->template",compact('img','code','link'));
        }

        return;

    }

}