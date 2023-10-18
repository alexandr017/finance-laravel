<?php
namespace App\Shortcodes\SlickSlider;

use App\Shortcodes\BaseShortcode;

class SlickSlideItem extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

        $src = $shortcode->src;
        $alt = $shortcode->alt;

        $href = $shortcode->href;

        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/slick_slider/item/$this->template.blade.php")) {
            return view("short_codes.slick_slider.item.$this->template",compact('src', 'alt','href'));
        }

        return;
    }

}