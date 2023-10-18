<?php
namespace App\Shortcodes\Comparison;


use App\Shortcodes\BaseShortcode;

class ComparisonInner extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
      	$title = $shortcode->title;
        $GLOBALS['_comparison'][] = ['title' => $title, 'content' => $content];
        return;
    }

}