<?php
namespace App\Shortcodes\GoogleTrends;

use App\Shortcodes\BaseShortcode;

class GoogleTrends extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

        return '';

        $title = $shortcode->title;

        if(\response::check_mobile()){
            return '';
        }

        if (! isset($this->template)) {
            return;
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/google_trends/$this->template.blade.php")) {
            return view("short_codes.google_trends.$this->template", compact('title'));
        }

        return;
    }

}