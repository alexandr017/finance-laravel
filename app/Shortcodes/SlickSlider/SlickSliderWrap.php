<?php
namespace App\Shortcodes\SlickSlider;

use App\Shortcodes\BaseShortcode;

class SlickSliderWrap extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

        $pcShow = $shortcode->pc_show ?? 3;
        $mobShow = $shortcode->mob_show ?? 1;

        $sliderId = str_random(10);

        if ( !isset($GLOBALS['shortCodeSlider'])) {
            $GLOBALS['shortCodeSlider'] = [];
        }

        $GLOBALS['shortCodeSlider'][] = [
            'sliderId' => $sliderId,
            'pcShow' => $pcShow,
            'mobShow' => $mobShow
        ];

        if (!in_array('slider',$GLOBALS['short_code_css'])) {
            $GLOBALS['short_code_css'][] = 'slider';
        }

        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/slick_slider/wrap/$this->template.blade.php")) {
            return view("site.v3.shortcodes.slick_slider.wrap.$this->template",compact('sliderId','content'));
        }

        return;
    }

}