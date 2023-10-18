<?php
namespace App\Shortcodes\ReadMore;
use App\Models\Posts\Posts;
use App\Models\Posts\PostsCategories;
use App\Shortcodes\BaseShortcode;

class ReadMore extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        $id = ($shortcode->id != null) ? $shortcode->id : null;

        if($id == null) return '';

        $post = Posts::find($id);
        if($post == null) return '';

        $category = PostsCategories::find($post->pcid);
        if($category == null) return '';
        $category_alias = $category->alias_category;
        $link = '/' . $category_alias .'/' .$post->alias . '.html';

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('read_more',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='read_more';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/read_more/$this->template.blade.php")) {
            return view("short_codes.read_more.$this->template",compact('post','link','content'));
        }

        return;
    }

}