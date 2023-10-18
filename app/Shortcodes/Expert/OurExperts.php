<?php
namespace App\Shortcodes\Expert;

use App\Shortcodes\BaseShortcode;
use App\Models\Expert\Expert as Model;

class OurExperts extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false)
    {
        $experts = Model::all();
        if($experts == null) {
            return;
        }

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('our_experts',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='our_experts';
        }

        if (file_exists(resource_path() . "/views/short_codes/expert/our_experts/$this->template.blade.php")) {
            return view("short_codes.expert.our_experts.$this->template",compact('experts'));
        }
    }

}