<?php
namespace App\Shortcodes\AuthorsCode;

use App\Models\Posts\Authors;
use App\Shortcodes\BaseShortcode;
use Cache;

class AuthorsCode extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        $id = ($shortcode->id != null) ? $shortcode->id : null;

        if($id == null || $id=='' || $id == 0) return '';


        $current_author = null;
        $authors = Cache::rememberForever('authors', function(){
            return Authors::all();
        });
        foreach ($authors as $key => $author) {
            if($author->id == $id) $current_author = $author;
        }

        if($current_author == null) return '';
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('authors_code',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='authors_code';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/authors_code/$this->template.blade.php")) {
            return view("short_codes.authors_code.$this->template", compact('content','current_author'));
        }

        return;
    }

}