<?php
namespace App\Shortcodes\RelatedPosts;
use App\Shortcodes\BaseShortcode;
use DB;
use Cache;

class RelatedPosts extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        $posts = $shortcode->posts;
        $terms = $shortcode->terms;
        if($posts == 0) return '';
        $posts = str_replace(',', ' or id=', $posts);
        $postsDB = DB::select("select * from posts where id=$posts");
        if($terms != ''){
            $terms = str_replace(',', ' or id=', $terms);
            $termsDB = DB::select("select * from dictionary where id=$terms");
        }

        $posts_categories = Cache::rememberForever('posts_categories', function(){
            return PostsCategories::all();
        });

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('related_posts',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='related_posts';
        }
        // pc, mob, turbo, amp
        $arr = compact('postsDB','posts_categories');
        if($terms && $termsDB){
            $arr['terms'] = $terms;
            $arr['termsDB'] = $termsDB;
        }
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/related_posts/$this->template.blade.php")) {
            return view("site.v3.shortcodes.related_posts.$this->template",$arr);
        }

        return;
    }

}