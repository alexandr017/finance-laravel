<?php
namespace App\Shortcodes\Forms;

use App\Shortcodes\BaseShortcode;

class CompanyAdd extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/forms/company_add/$this->template.blade.php")) {
            return view("short_codes.forms.company_add.$this->template");
        }

        return;
    }

}