<?php
namespace App\Shortcodes\GoToAccount;

use App\Shortcodes\BaseShortcode;

class GoToAccount extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        $logo = ($shortcode->logo != null) ? $shortcode->logo : '';
        $link = ($shortcode->link != null) ? $shortcode->link : '';
        $link2 = $shortcode->link2;
        $alt = ($shortcode->alt != null) ? $shortcode->alt : '';
        $goal_name_0 = $shortcode->goal_name_0;
        $goal_name = $shortcode->goal_name;

        $content = str_replace('<p>','',$content);
        $content = str_replace('</p>','',$content);

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('go_to_account',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='go_to_account';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/go_to_account/$this->template.blade.php")) {
            return view("short_codes.go_to_account.$this->template",compact('logo','alt','content', 'link', 'link2','goal_name','goal_name_0'));
        }

        return;

    }

}