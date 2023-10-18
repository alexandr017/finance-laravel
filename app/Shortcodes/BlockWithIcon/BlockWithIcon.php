<?php
namespace App\Shortcodes\BlockWithIcon;

use App\Shortcodes\BaseShortcode;

class BlockWithIcon extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        $icon = $shortcode->icon;
        $color = $shortcode->color;
        $background = $shortcode->background;

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('block_with_icon',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='block_with_icon';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/block_with_icon/$this->template.blade.php")) {
            return view("short_codes.block_with_icon.$this->template", compact('content','icon','color','background'));
        }

        return;
    }

}