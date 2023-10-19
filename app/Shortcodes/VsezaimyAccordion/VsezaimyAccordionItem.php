<?php
namespace App\Shortcodes\VsezaimyAccordion;

use App\Shortcodes\BaseShortcode;

class VsezaimyAccordionItem extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
	  	$title = $shortcode->title;
	  	$show = ($shortcode->show == true) ? 'display: block;' : '';

        $GLOBALS['FAQPage'][] = [
            'name' => $title,
            'text' => $content
        ];

        if (! isset($this->template)) {
            return;
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/vsezaimy_accordion/vsezaimy_accordion_item/$this->template.blade.php")) {
            return view("site.v3.shortcodes.vsezaimy_accordion.vsezaimy_accordion_item.$this->template",compact('content','title','show'));
        }

        return;
    }

}