<?php
namespace App\Shortcodes\VzoNews;

use App\Shortcodes\BaseShortcode;
use Illuminate\Support\Facades\DB;

class VzoNews extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        $vzo_news = DB::table('posts')
            ->select('posts.*')
            ->where(['posts.pcid'=>14,'posts.status' => 1])
            ->orderBy('posts.id', 'desc')
            ->limit(3)
            ->get();
        // pc, mob, turbo, amp
        if(!in_array('vzo_news',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='vzo_news';
        }
        if (file_exists(resource_path() . "/views/short_codes/vzo_news/$this->template.blade.php")) {
            return view("short_codes.vzo_news.$this->template",compact('vzo_news'));
        }

        return;
    }

}