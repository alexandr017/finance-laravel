<?php
namespace App\Shortcodes\StructuredDataVideo;

class SDV {

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

        global $structured_data_video;


        $structured_data_video [] = (object) [
            'name' => $shortcode->name,
            'description'  => $shortcode->description,
            'thumbnailUrl'  => $shortcode->thumbnailurl,
            'uploadDate'  => $shortcode->uploaddate,
            'contentUrl'  => $shortcode->contenturl,
            'interactionCount'  => $shortcode->interactioncount
        ];


    }

}