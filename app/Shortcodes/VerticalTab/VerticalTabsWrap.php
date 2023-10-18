<?php
namespace App\Shortcodes\VerticalTab;

use App\Shortcodes\BaseShortcode;

class VerticalTabsWrap extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false)
    {

        if (!isset($GLOBALS['vertical_tabs'])) {
            return  '';
        }

        $URL = $_SERVER['REQUEST_URI'];

        if (preg_match('/\/amp\/?$/', $URL)) {
            $res = '';
            foreach ($GLOBALS['vertical_tabs'] as $key => $value) {
                $res .= $value;
            }
            return $res;

        }

        $content = [];
        foreach ($GLOBALS['vertical_tabs'] as $key => $value) {
            $content['titles'][] = $value['title'];
            $content['descs'][] = $value['content'];
        }

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('vertical_tab',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='vertical_tab';
        }
        if(!in_array('vertical_tab',$GLOBALS['short_code_js'])){
            $GLOBALS['short_code_js'][]='vertical_tab';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/vertical_tab/vertical_tab_wrap/$this->template.blade.php")) {
            return view("short_codes.vertical_tab.vertical_tab_wrap.$this->template",compact('content'));
        }

        return '';

    }

}