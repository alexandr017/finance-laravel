<?php
namespace App\Shortcodes\InsertVideo;

use App\Shortcodes\BaseShortcode;

class InsertVideo extends BaseShortcode {

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

        $image = $shortcode->thumbnailurl;
        $alt = $shortcode->name;
        $video = $shortcode->contenturl;

        global $structured_data_video;

        $structured_data_video [] = (object) [
            'name' => $shortcode->name,
            'description'  => $shortcode->description,
            'thumbnailUrl'  => $shortcode->thumbnailurl,
            'uploadDate'  => $shortcode->uploaddate,
            'contentUrl'  => $shortcode->contenturl
        ];
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('insert_video',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='insert_video';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/insert_video/$this->template.blade.php")) {
            return view("site.v3.shortcodes.insert_video.$this->template",compact('image','alt','video'));
        }

        return;

    }

}