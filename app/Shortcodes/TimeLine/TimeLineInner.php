<?php
namespace App\Shortcodes\TimeLine;

use App\Shortcodes\BaseShortcode;

class TimeLineInner extends BaseShortcode {

    public function register($shortcode, $content, $compiler, $name, $viewData = false)
    {
        $arr = [
            'bold_text' => $shortcode->bold_text,
            'content' => $content
        ];

        $GLOBALS['SHORTCODE_time_line_inner'][] = $arr;
        return;
    }

}