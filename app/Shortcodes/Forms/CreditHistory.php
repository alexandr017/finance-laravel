<?php
namespace App\Shortcodes\Forms;

use App\Shortcodes\BaseShortcode;

class CreditHistory extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/forms/credit_history/$this->template.blade.php")) {
            return view("site.v3.shortcodes.forms.credit_history.$this->template");
        }

        return;
    }

}