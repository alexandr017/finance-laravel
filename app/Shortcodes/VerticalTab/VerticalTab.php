<?php
namespace App\Shortcodes\VerticalTab;

use App\Shortcodes\BaseShortcode;

class VerticalTab extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
      	$title = $shortcode->title;
        $arr = array('title'=>$title,'content'=>$content);

    	$URL = $_SERVER['REQUEST_URI'];
        if (preg_match('/\/amp\/?$/', $URL))
        {
            if ($shortcode->no_amp === null) {
                if(!in_array('vertical_tab',$GLOBALS['short_code_css'])){
                    $GLOBALS['short_code_css'][]='vertical_tab';
                }
                $GLOBALS['vertical_tabs'][] = view("short_codes.vertical_tab.vertical_tab.amp",compact('content','title'));
            } else {
                $GLOBALS['vertical_tabs'][] = '';
            }
            return;
        }

        $GLOBALS['vertical_tabs'][] = $arr;

        return '';
    }

}