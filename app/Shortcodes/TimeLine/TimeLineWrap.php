<?php
namespace App\Shortcodes\TimeLine;

use App\Shortcodes\BaseShortcode;

class TimeLineWrap extends BaseShortcode {
    public function register($shortcode, $content, $compiler, $name, $viewData = false)
    {
        $innerItems = $GLOBALS['SHORTCODE_time_line_inner'];
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('time_line',$GLOBALS['short_code_css'])){
                    $GLOBALS['short_code_css'][]='time_line';
        }
        // pc, mob, turbo, amp
        if(!in_array('time_line',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='time_line';
        }
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/time_line/$this->template.blade.php")) {
            return view("site.v3.shortcodes.time_line.$this->template",compact('innerItems'));
        }

        return;
    }
}