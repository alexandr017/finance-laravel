<?php
namespace App\Shortcodes\BGBlock;
use App\Shortcodes\BaseShortcode;

class BGBlock extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
      	$color = ($shortcode->color != null) ? $shortcode->color : '';
        if($color == ''){
            $colorClass = 'bg_post_default';
        } else {
            $colorClass = 'bg_post_'.$color;

        }
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('bg_block',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='bg_block';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/bg_block/$this->template.blade.php")) {
            return view("short_codes.bg_block.$this->template", compact('colorClass','content'));
        }

        return;
    }

}